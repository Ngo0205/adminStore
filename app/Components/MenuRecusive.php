<?php

namespace App\Components;

use App\Models\Menu;

class MenuRecusive
{
    private $htmlOption;

    public function __construct()
    {
        $this->htmlOption = '';
    }
//  đệ quy lấy menu sản phẩm
    public function recusiveMenu($parentId = 0, $subText = '')
    {

        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $itemMenu) {
            $this->htmlOption .= '<option value="' . $itemMenu['id'] . '">' . $subText . $itemMenu->name . '</option>';
            $this->recusiveMenu($itemMenu->id, $subText . '--');
        }
        return $this->htmlOption;
    }

    public function recusiveMenuEdit($parentIDEdit, $parentId = 0, $subText = '')
    {
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $itemMenu) {
            if($itemMenu['id'] == $parentIDEdit){
                $this->htmlOption .= '<option selected value="' . $itemMenu['id'] . '">' . $subText . $itemMenu->name . '</option>';
            }else{
                $this->htmlOption .= '<option value="' . $itemMenu['id'] . '">' . $subText . $itemMenu->name . '</option>';
            }
            $this->recusiveMenuEdit($parentIDEdit, $itemMenu['id'], $subText . '--');
        }
        return $this->htmlOption;
    }
}
