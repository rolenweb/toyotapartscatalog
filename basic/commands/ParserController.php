<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\helpers\Console;
use app\models\Link;
use app\models\ModelCar;
use app\models\Frame;
use app\models\Complectation;
use app\models\ComplectationOption;
use app\models\PartsGroups;
use app\models\Parts;
use app\commands\tools\CurlClient;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ParserController extends BaseCommand
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
    	for (;;) { 
    		$start = time();
    		$link = Link::findOne(['status' => Link::STATUS_WATING]);
	        if (empty($link)) {
	        	$url = 'http://toyota-usa.epc-data.com/tacoma/';
	        }else{
	        	$url = $link->url;
	        }
	        $this->success('Parse url: '.$url);

	        $client = new CurlClient();
	        $content = $client->parsePage($url);
	        
	        $breadcrumbs = $this->breadCrumbs($client,$content,$url);
	        if (empty($breadcrumbs['links']) === false && empty($breadcrumbs['title']) === false) {
	        	switch (count($breadcrumbs['links'])) {
	        		case '1':
	        			$this->whisper('It is home page');
	        			$this->saveLinks($client,$content,$url);
	        			break;

	        		case '2':
	        			$this->whisper('Try to save model page: '.$breadcrumbs['title']);
	        			$this->saveModel($breadcrumbs);
	        			$this->saveLinks($client,$content,$url);
	        			break;

	        		case '3':
	        			$this->whisper('Try to save frame page: '.$breadcrumbs['title']);
	        			$this->saveFrame($breadcrumbs);
	        			$this->saveLinks($client,$content,$url);
	        			break;

	        		case '4':
	        			$this->whisper('Try to save complectation page: '.$breadcrumbs['title']);
	        			$this->saveComplectation($breadcrumbs,$client,$content);
	        			$this->saveLinks($client,$content,$url);
	        			break;

	        		case '5':
	        			$this->whisper('Collect links on page: '.$breadcrumbs['title']);
	        			$this->saveLinks($client,$content,$url);
	        			break;

	        		case '6':
	        			$this->whisper('Try to save Parts groups: '.$breadcrumbs['title']);
	        			$this->savePartsGroups($breadcrumbs,$client,$content);
	        			$this->saveLinks($client,$content,$url);
	        			break;
	        		
	        		default:
	        			# code...
	        			break;
	        	}
	        	if (empty($link) === false) {
	        		$link->status = Link::STATUS_PARSED;
	        		$link->save();
	        	}
	        }
	        $finish = time();
            $dif = $finish-$start;
            if ($dif < 3) {
            	$sleep = rand(1,5);
		        $this->success($sleep.' secs');
		        sleep($sleep);
            }
	        
    	}
        
    }

    public function breadCrumbs($client,$content,$url)
    {
    	$links = $client->parseProperty($content,'link','div.path a',$url,null);
    	if (empty($links)) {
    		$this->error('Bread Crumbs links is null');
    		return;
    	}
    	$anchors = $client->parseProperty($content,'string','div.path a',$url,null);
    	if (empty($anchors)) {
    		$this->error('Anchors is null');
    		return;
    	}
    	$name = $client->parseProperty($content,'string','div.path span',$url,null);
    	if (empty($name[0])) {
    		$this->error('Bread Crumbs Span is null');
    		return;
    	}
    	return [
    		'links' => $links,
    		'anchors' => $anchors,
    		'title' => $name[0],
    	];
    }

    public function saveLinks($client,$content,$url)
    {
    	$links = $client->parseProperty($content,'link','a',$url,null);
    	if (empty($links)) {
    		$this->error('Links is null');
    		return;
    	}
    	$blackUrls = Link::blackUrl();
    	$clear_links = array_diff($links,$blackUrls);
    	if (empty($clear_links)) {
    		$this->error('Clear Links is null');
    		return;
    	}
    	$total = count($clear_links);
    	$i = 0;
    	$new = 0;
    	$saved = 0;
    	$this->success($total.' links is found');
    	Console::startProgress($i, $total);
    	foreach ($clear_links as $item) {
    		Console::updateProgress(++$i, $total);
    		if (Link::filterHost(trim($item))) {
    			$new_link = new Link();
	    		$new_link->url = trim($item);
	    		$new_link->status = Link::STATUS_WATING;
	    		if ($new_link->save()) {
	    			$new++;
	    		}else{
	    			foreach ($new_link->getErrors() as $er) {
	                }
	                $saved++;
	    		}
    		}
    	}
    	Console::endProgress();
    	$this->success($new.' links is saved and '.$saved.' is allready saved');
    	return;
    }

    public function saveModel($breadcrumbs)
    {
		$new_model = new ModelCar();
		$new_model->title = $breadcrumbs['title'];
		if ($new_model->save()) {
			$this->success($breadcrumbs['title'].' model is saved');
		}else{
			foreach ($new_model->getErrors() as $er) {
                $this->whisper($er[0]);
            }
		}
		return;
    }

    public function saveFrame($breadcrumbs)
    {
    	$model_title = $breadcrumbs['anchors'][count($breadcrumbs['anchors'])-1];
    	if (empty($model_title)) {
    		$this->error('Model title is null');
    		return;
    	}
    	$model = ModelCar::find()->where(['title' => trim($model_title)])->limit(1)->one();
    	if (empty($model)) {
    		$this->error('Model is null');
    		return;
    	}
		$new_frame = new Frame();
		$new_frame->title = $breadcrumbs['title'];
		$new_frame->model_id = $model->id;
		if ($new_frame->save()) {
			$this->success($breadcrumbs['title'].' frame is saved');
		}else{
			foreach ($new_frame->getErrors() as $er) {
                $this->whisper($er[0]);
            }
		}
		return;
    }

    public function saveComplectation($breadcrumbs,$client,$content)
    {
    	$frame_title = $breadcrumbs['anchors'][count($breadcrumbs['anchors'])-1];
    	if (empty($frame_title)) {
    		$this->error('Frame title is null');
    		return;
    	}
    	$frame = Frame::find()->where(['title' => trim($frame_title)])->limit(1)->one();
    	if (empty($frame)) {
    		$this->error('Frame is null');
    		return;
    	}
    	$period = $client->parseProperty($content,'string','table.top_cars table.table tr:nth-of-type(1) td:nth-of-type(2)',null,null);

    	$engine = $client->parseProperty($content,'string','table.top_cars table.table tr:nth-of-type(5) td:nth-of-type(1) span',null,null);

    	$engine_title = $client->parseProperty($content,'attribute','table.top_cars table.table tr:nth-of-type(5) td:nth-of-type(1) span',null,'title');

    	$body = $client->parseProperty($content,'string','table.top_cars table.table tr:nth-of-type(5) td:nth-of-type(2) span',null,null);

    	$body_title = $client->parseProperty($content,'attribute','table.top_cars table.table tr:nth-of-type(5) td:nth-of-type(2) span',null,'title');

    	$grade = $client->parseProperty($content,'string','table.top_cars table.table tr:nth-of-type(5) td:nth-of-type(3) span',null,null);

    	$grade_title = $client->parseProperty($content,'attribute','table.top_cars table.table tr:nth-of-type(5) td:nth-of-type(3) span',null,'title');

    	$transm = $client->parseProperty($content,'string','table.top_cars table.table tr:nth-of-type(5) td:nth-of-type(4) span',null,null);

    	$transm_title = $client->parseProperty($content,'attribute','table.top_cars table.table tr:nth-of-type(5) td:nth-of-type(4) span',null,'title');

    	$options = $client->parseProperty($content,'string','table.top_cars table.table tr:nth-of-type(5) td:nth-of-type(5) span',null,null);

    	$options_title = $client->parseProperty($content,'attribute','table.top_cars table.table tr:nth-of-type(5) td:nth-of-type(5) span',null,'title');

    	$new_complectation = new Complectation();
		$new_complectation->frame_id = $frame->id;
		$new_complectation->complectation = $breadcrumbs['title'];
		$new_complectation->period = (empty($period[0]) === false) ? $period[0] : null;
		$new_complectation->engine = (empty($engine[0]) === false) ? $engine[0] : null;
		$new_complectation->engine_title = (empty($engine_title[0]) === false) ? $engine_title[0] : null;
		$new_complectation->body = (empty($body[0]) === false) ? $body[0] : null;
		$new_complectation->body_title = (empty($body_title[0]) === false) ? $body_title[0] : null;
		$new_complectation->grade = (empty($grade[0]) === false) ? $grade[0] : null;
		$new_complectation->grade_title = (empty($grade_title[0]) === false) ? $grade_title[0] : null;
		$new_complectation->transm = (empty($transm[0]) === false) ? $transm[0] : null;
		$new_complectation->transm_title = (empty($transm_title[0]) === false) ? $transm_title[0] : null;
		if ($new_complectation->save()) {
			$this->success($new_complectation->complectation.' complectation is saved');
			if (empty($options) === false) {
				foreach ($options as $nop => $single) {
					$new_complectation_option = new ComplectationOption();
					$new_complectation_option->complectation_id = $new_complectation->id;
					$new_complectation_option->title = $single;
					$new_complectation_option->description = (empty($options_title[$nop]) === false) ? $options_title[$nop] : null;
					if ($new_complectation_option->save()) {
						# code...
					}else{
						foreach ($new_complectation_option->getErrors() as $er) {
			                $this->whisper($er[0]);
			            }
					}
				}
			}

		}else{
			foreach ($new_complectation->getErrors() as $er) {
                $this->whisper($er[0]);
            }
		}
		return;
    }

    public function savePartsGroups($breadcrumbs,$client,$content)
    {
    	$complectation_title = $breadcrumbs['anchors'][count($breadcrumbs['anchors'])-2];
    	if (empty($complectation_title)) {
    		$this->error('Complectation title is null');
    		return;
    	}
    	$complectation = Complectation::find()->where(['complectation' => trim($complectation_title)])->limit(1)->one();
    	if (empty($complectation)) {
    		$this->error('Complectation is null');
    		return;
    	}

    	$part_group_type = $breadcrumbs['anchors'][count($breadcrumbs['anchors'])-1];

    	switch ($part_group_type) {
    		case 'Engine, fuel system and tools':
				$part_group_type_id = PartsGroups::TYPE_ENGINE;    			
    			break;
    		
    		case 'Transmission and chassis':
				$part_group_type_id = PartsGroups::TYPE_CHASSIS;    			
    			break;

    		case 'Body and interior':
				$part_group_type_id = PartsGroups::TYPE_BODY;			
    			break;

    		case 'Electrics':
				$part_group_type_id = PartsGroups::TYPE_ELECTRIC;
    			break;
    		
    	}

    	$old_parts_group = PartsGroups::findOne([
    			'complectation_id' => $complectation->id,
    			'type' => $part_group_type_id,
    			'title' => trim($breadcrumbs['title'])
    		]);
    	if (empty($old_parts_group)) {
    		$new_part_group = new PartsGroups();
    		$new_part_group->complectation_id = $complectation->id;
    		$new_part_group->type = $part_group_type_id;
    		$new_part_group->title = trim($breadcrumbs['title']);
    		if ($new_part_group->save()) {
    			# code...
    		}else{
    			foreach ($new_part_group->getErrors() as $er) {
			        $this->whisper($er[0]);
			    }
    		}
    	}
		$pgid = (empty($new_part_group) === false) ? $new_part_group->id : $old_parts_group->id;
		$this->saveParts($client,$content,$pgid);
		return;
    }

    public function saveParts($client,$content,$pgid)
    {
    	$pnc = $client->parseProperty($content,'string','tr.parts-in-stock-widget_part-row td:nth-of-type(2)',null,null);
    	$oem = $client->parseProperty($content,'string','tr.parts-in-stock-widget_part-row td:nth-of-type(3) b',null,null);
    	$required = $client->parseProperty($content,'string','tr.parts-in-stock-widget_part-row td:nth-of-type(4)',null,null);
    	$period = $client->parseProperty($content,'string','tr.parts-in-stock-widget_part-row td:nth-of-type(5)',null,null);
    	$name = $client->parseProperty($content,'string','tr.parts-in-stock-widget_part-row td:nth-of-type(6)',null,null);
    	$applicability = $client->parseProperty($content,'string','tr.parts-in-stock-widget_part-row td:nth-of-type(7)',null,null);
    	$price = $client->parseProperty($content,'string','tr.parts-in-stock-widget_part-row td.priceRangeContainer a strong',null,null);

    	if (empty($oem) === false) {
    		foreach ($oem as $n => $item) {
    			$new_parts = new Parts();
    			$new_parts->parts_groups_id = $pgid;
    			$new_parts->pnc = (empty($pnc[$n]) === false) ? trim($pnc[$n]) : null;
    			$new_parts->oem = $item;
    			$new_parts->required = (empty($required[$n]) === false) ? trim($required[$n]) : null;
    			$new_parts->period = (empty($period[$n]) === false) ? trim($period[$n]) : null;
    			$new_parts->name = (empty($name[$n]) === false) ? trim($name[$n]) : null;
    			$new_parts->applicability = (empty($applicability[$n]) === false) ? trim($applicability[$n]) : null;
    			$new_parts->price = (empty($price[$n]) === false) ? trim($price[$n]) : null;
    			if ($new_parts->save()) {
    				foreach ($new_parts->getErrors() as $er) {
				        $this->whisper($er[0]);
				    }
    			}
    		}
    	}
    	return;
    }

}
