<?php

namespace App\Traits;

/**
 * FlashMessages Trait
 *
 * You can flash an alert of various levels using the below trait
 * The correct syntax is to use self::message('level','message','title','dismissable'), but shorthand alternatives are available
 */
trait FlashMessages
{
    /**
     * Flash message to session
     *
     * @param  string  $level
     * @param  string|null  $message
     * @param  string|null  $title
     * @param  bool  $dismissable
     * @return void
     */
    protected static function message($level = 'info', $message = null, $title = false, $dismissable = false, $actions = false)
    {
        if (session()->has('messages')) {
            $messages = session()->pull('messages');
        }

        $messages[] = $message = ['level' => $level, 'message' => $message, 'dismissable' => $dismissable, 'title' => $title, 'actions' => $actions];

        session()->flash('messages', $messages);

        return $message;
    }

    /**
     * Get messages
     *
     * @return array
     */
    protected static function messages()
    {
        return self::hasMessages() ? session()->pull('messages') : [];
    }

    /**
     * hasMessages()
     *
     * @return bool
     */
    protected static function hasMessages()
    {
        return session()->has('messages');
    }

    /**
     * Flash a success message to the session
     *
     * @param  string  $message
     * @param  string  $title
     * @param  bool  $dismissable
     * @return void
     */
    protected static function success($message, $title = false, $dismissable = false, $actions = false)
    {
        return self::message('success', $message, $title, $dismissable, $actions);
    }

    /**
     * Flash an info message to the session
     *
     * @param  string  $message
     * @param  string  $title
     * @param  bool  $dismissable
     * @return void
     */
    protected static function info($message, $title = false, $dismissable = false, $actions = false)
    {
        return self::message('info', $message, $title, $dismissable, $actions);
    }

    /**
     * Flash a warning message to the session
     *
     * @param  string  $message
     * @param  string  $title
     * @param  bool  $dismissable
     * @return void
     */
    protected static function warning($message, $title = false, $dismissable = false, $actions = false)
    {
        return self::message('warning', $message, $title, $dismissable, $actions);
    }

    /**
     * Flash a danger message to the session
     *
     * @param  string  $message
     * @param  string  $title
     * @param  bool  $dismissable
     * @return void
     */
    protected static function danger($message, $title = false, $dismissable = false, $actions = false)
    {
        return self::message('danger', $message, $title, $dismissable, $actions);
    }
}
