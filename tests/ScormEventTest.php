<?php namespace XREmitter\Tests;
use \XREmitter\Events\ScormEvent as Event;

class ScormEventTest extends ModuleViewedTest {
    protected static $recipe_name = 'scorm_event';

    /**
     * Sets up the tests.
     * @override ModuleViewedTest
     */
    public function setup() {
        $this->event = new Event($this->repo);
    }

    protected function constructInput() {
        return array_merge(parent::constructInput(), [
            'scorm_scoes_track' => [
                'status' => 'completed',
            ],
            'cmi_data' => [
                'cmivalue' => 'completed',
                'cmielement' => 'cmi.core.lesson_status',
                'attemptid' => 2,
            ],
            'scorm_scoes' => $this->constructScormScoes(),
        ]);
    }

    protected function constructScormTracking() {
        return [
            'scorm_score_raw' => 100,
            'scorm_score_min' => 0,
            'scorm_score_scaled' => 1,
            'scorm_score_max' => 100,
            'scorm_status' => 'completed',
        ];
    }

    protected function constructScormScoes() {
        return [
            'scorm_scoes_id' =>  1,
            'scorm_scoes_url' =>  'http://www.example.com/module_url',
            'scorm_scoes_type' => static::$xapi_type.'sco',
            'scorm_scoes_name' => 'Sco name',
            'scorm_scoes_description' => 'Sco Description',
        ];
    }

}