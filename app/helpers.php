<?php




if (!function_exists('sort_comments')) {
    function sort_comments($comments, $parrentId = null) {
        $result = [];

        foreach ($comments as $comment) {

            if ($comment->parent_id === $parrentId) {
                $data = $comment->toArray();
                $data['children'] = sort_comments($comments, $comment->id);
                $result[] = $data;
            }
        }
        return $result;
    }
}
