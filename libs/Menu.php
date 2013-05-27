<?php
/**
 * Creado por Luis Remicio
 */
class Menu {
    private $arrayMenu;
    public function  __construct($_arrayMenu=array()) {
        //var_export($_arrayMenu);
        $this->arrayMenu = count($_arrayMenu)>0?$_arrayMenu:array(array ('men_id' => '1','men_nombre' => 'Permisos de Formulario no Registrados','men_url' => '','men_nivel' => '0','men_padre' => '0'));
    }
    public function getMenu(){
        $menu = "tb.add(";
        $menux="";
        $array = $this->getMenuRecursivo();
        foreach ($array as $fila){
                ++$i;
                $menux.="{";
                $menux.="text:'".trim($fila['men_nombre'])."'";
                $menux.=",id:'laro".$i."'";
                $menux.=",iconCls: 'btn_form'";
                if(trim($fila['men_url']) != '' )
                    $menux.=",listeners: {
                                click:function(){
                                    win.show({vurl:\"".$fila['men_url']."\"});
                                }
                            }";
                if(count($fila['nhijos'])>0){
                    $menux.=",menu: {
                                items: [";
                    $menux.=$this->getRecursividad($fila['nhijos']);
                    $menux.="]}";
                }
                $menux.="},";
        }
        $len = strlen($menux);
        $len-=1;
        $menu.=substr($menux, 0, $len);
        $menu.=");";
        return $menu;
    }
    public function getRecursividad($_array){
        $menu = "";
        foreach ($_array as $fila){
            $menu.="{";
            $menu.="text: '".trim($fila['men_nombre'])."'";
            if(trim($fila['men_url']) != '' )
                $menu.=",listeners: {
                            click:function(){
                                win.show({vurl:\"".$fila['men_url']."\"});
                            }
                        }";
            if(count($fila['nhijos'])>0){
                $menu.=$this->getRecursividad00($fila['nhijos']);
            }
            $menu.="},";
        }
        $len = strlen($menu);
        $len-=1;
        $menu=substr($menu, 0, $len);
        return $menu;
    }
    public function getRecursividad00($_array){
        $menu = ",menu: { items: [";
        foreach ($_array as $fila){
            $menu.="{";
            $menu.="text: '".trim($fila['men_nombre'])."'";
            if(trim($fila['men_url']) != '' )
                $menu.=",listeners: {
                            click:function(){
                                win.show({vurl:\"".$fila['men_url']."\"});
                            }
                        }";
            if(count($fila['nhijos'])>0){
                $menu.=$this->getRecursividad00($fila['nhijos']);
            }
            $menu.="},";
        }
        $len = strlen($menu);
        $len-=1;
        $menu=substr($menu, 0, $len);
        $menu.="]}";
        return $menu;
    }
    public function getMenuRecursivo(){
        $array = array();
        foreach ($this->arrayMenu as $fila){
            if(intval($fila['men_padre'])==0){
                $fila['nhijos'] = $this->getMenuInterno($fila['men_id']);
                $array[]=$fila;
            }
        }
        return $array;
    }
    public function getMenuInterno($_parent){
        $array = array();
        foreach ($this->arrayMenu as $fila){
            if(intval($_parent)==intval($fila['men_padre'])){
                $fila['nhijos'] = $this->getMenuInterno($fila['men_id']);
                $array[]=$fila;
            }
        }
        return $array;
    }
}
?>
