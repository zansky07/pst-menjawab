<?php
    namespace App\Models;
    // defined('BASEPATH') OR exit('No direct script access allowed');
    


    class KeywordModel {

        protected $file = WRITEPATH . 'data/keywords.json'; // simpan di writable/data/keywords.json

        public function getAll()
        {
            if (!file_exists($this->file)) {
                return [];
            }

            $json = file_get_contents($this->file);
            return json_decode($json, true) ?? [];
        }

        public function saveAll($keywords)
        {
            return (bool) file_put_contents($this->file, json_encode($keywords, JSON_PRETTY_PRINT));
        }

        public function add($keyword, $response_link)
        {
            $data = $this->getAll();
            $data[] = [
                'id'            => uniqid(), // generate ID unik
                'keyword'       => $keyword,
                'link' => $response_link
            ];
            return $this->saveAll($data) ? true : false;
        }

        public function update($id, $keyword, $response_link)
        {
            $data = $this->getAll();
            foreach ($data as &$item) {
                if ($item['id'] == $id) {
                    $item['keyword']       = $keyword;
                    $item['link'] = $response_link;
                    break;
                }
            }
            
            return $this->saveAll($data) ? true : false;
        }

        public function delete($id)
        {
            $keywords = $this->getAll();

            $found = false;
            foreach ($keywords as $key => $row) {
                if ($row['id'] == $id) {
                    unset($keywords[$key]);
                    $found = true;
                    break;
                }
            }

            if ($found) {
                file_put_contents($this->file, json_encode(array_values($keywords), JSON_PRETTY_PRINT));
                return true;
            }

            return false;
        }

        public function find($id)
        {
            $data = $this->getAll();
            foreach ($data as $item) {
                if ($item['id'] == $id) {
                    return $item;
                }
            }
            return null;
        }
}