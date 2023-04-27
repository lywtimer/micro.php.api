<?php

    namespace service;

    /**
     * 用户中心
     */
    class User
    {
        /**
         * 获取用户信息
         * @param $id
         * @return array
         */
        public function getUser($id)
        {
            //todo from db
            return [
                'id' => $id,
                'name' => "周杰伦",
                'age' => 18,
            ];
        }
    }