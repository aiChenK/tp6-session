<?php

namespace KaySess;

use think\App;
use think\Session as TpSession;

/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2020-09-17
 * Time: 16:00
 */

class Session
{
    /** @var TpSession */
    protected $session;

    public function __construct(App $app, TpSession $session)
    {
        $this->session = $session;

        // Session初始化
        $varSessionId = $app->config->get('session.var_session_id');
        $cookieName   = $this->session->getName();

        if ($varSessionId && $app->request->request($varSessionId)) {
            $sessionId = $app->request->request($varSessionId);
        } else {
            $sessionId = $app->request->cookie($cookieName);
        }

        if ($sessionId) {
            $this->session->setId($sessionId);
        } else {
            $app->cookie->set($cookieName, $this->session->getId());
        }

        $this->session->init();
        $app->request->withSession($this->session);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->session, $name], $arguments);
    }

    // 保存
    public function __destruct()
    {
        $this->session->save();
    }
}