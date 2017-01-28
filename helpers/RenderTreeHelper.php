<?php

namespace usesgraphcrt\faq\helpers;


class RenderTreeHelper
{
    /**
     * @param $category
     * @return string
     */
    static function renderTree($category){
        $childrenTree ='';
        $childrenTree .= '<div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion'.$category['id'].'" href="#collapse'.$category['id'].'">'.$category['name'].'</a>
                    </h4>
                </div>
                <div id="collapse'.$category['id'].'" class="panel-collapse collapse">
                    <div class="panel-body">';
        if(!empty($category['childs'])) {
            foreach ($category->getChilds()->orderBy(['sort' => SORT_DESC])->all() as $subCategory){
                if (!empty($subCategory->getFaq()->orderBy(['sort' => SORT_DESC])->all()) && !empty($category->getChilds()->all())){
                    $childrenTree .= static::renderTree($subCategory);
                }
            }
        };
        $childrenTree .= '<ul class="nav nav-pills nav-stacked">';
        if (!empty($category->getFaq()->all())) {
            foreach ($category->getFaq()->orderBy(['sort' => SORT_DESC])->all() as $faq) {
                $childrenTree .= '<li>
                                    <a class="panel-content" data-role="faq-load"
                                    data-id="'.$faq->id.'"
                                       data-url="#/ajax-list-view?id='.$faq->id.'">' . $faq->title . '
                                    </a>
                                </li>';
            }
        }
        $childrenTree .='</ul>
                    </div>
                </div>
            </div>';

        return $childrenTree;
    }
}