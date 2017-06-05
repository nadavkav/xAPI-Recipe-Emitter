<?php namespace XREmitter\Events;

class H5PxAPIEvent extends Event {

    /**
     * Reads data for an event.
     * @param [String => Mixed] $opts
     * @return [String => Mixed]
     */
    public function read(array $opts) {
        $version = trim(file_get_contents(__DIR__.'/../../VERSION'));
        $version_key = 'https://github.com/LearningLocker/xAPI-Recipe-Emitter';
        $opts['context_info']->{$version_key} = $version;
        $xapi_statement = unserialize($opts['context_ext']['other']);
        return [
            'actor' => $this->readUser($opts, 'user'),
            'verb' => $xapi_statement['statement']['verb'],
            'object' => $xapi_statement['statement']['object'],
            'result' => $xapi_statement['statement']['result'],
            'context' => [
                'platform' => $opts['context_platform'],
                'language' => $opts['context_lang'],
                'extensions' => [
                    $opts['context_ext_key'] => $opts['context_ext'],
                    'http://lrs.learninglocker.net/define/extensions/info' => $opts['context_info'],
                ],
                'contextActivities' => [
                    'grouping' => [
                        $this->readApp($opts)
                    ],
                    'category' => [
                        $this->readSource($opts)
                    ]
                ],
            ],
            'timestamp' => $opts['time'],
        ];
    }
}
