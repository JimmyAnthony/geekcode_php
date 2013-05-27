<!DOCTYPE html>
<html lang="es">
    <head>
        <link href="/images/gestion.ico" type="image/x-icon" rel="shortcut icon" />
        <title><?php echo $p->title;?></title>
        <meta charset="utf-8">
        <link href="/css/normalize.css" rel="stylesheet">
        <link rel="stylesheet" href="/js/ext-4.2.0/resources/css/ext-all-gray.css">
        <link rel="stylesheet" href="/css/inicio.css">
        <link rel="stylesheet" href="/css/icons.css">
        <script src="/js/modernizr.js"></script>
        <script src="/js/ext-4.2.0/bootstrap.js"></script>
        <script src="/js/jquery-1.10.0.min.js"></script>
        <script src="/js/global.js"></script>
        <script type="text/javascript">
            /*window.onbeforeunload = confirmaSalida;  
            var datosModificadosSinGuardar = true;
            function confirmaSalida(){
                if (datosModificadosSinGuardar) {
                    return "Vas a abandonar esta pagina. Si has hecho algun cambio sin grabar vas a perder todos los datos."; 
                }
            }

            window.onunload = function(){
                if ( datosModificadosSinGuardar ){
                    
                }
            }*/
            
            Ext.Loader.setConfig({
                enabled: true,
                paths: {
                    'Ext.ux': '/js/ext-4.2.0/ux',
                    'Ext.global': '/js/global'
                }
            });
            Ext.require([
                '*'
            ]);

            var inicio = {
                id:'inicio',
                cClock: 60,
                reusable: null,
                reusable_00: null,
                init:function(){
                    Ext.tip.QuickTipManager.init();
                    /*
                     * Tiempo de espera de respuesta por lado del cliente
                     * Default: 3 minutos ( 1s = 1000 )
                     */
                    Ext.Ajax.timeout = 180000;

                    var vheader = '<header>'+
                                    '<div class="logo"></div>'+
                                    '<div class="caja_usuario"><img src="/images/icon/1342018264_Calendar.png"><span>Fecha:&nbsp;</span><label id="lbl_fecha">'+'<?php echo date("d/m/Y");?>'+'</label>&nbsp;<img src="/images/icon/1342018436_clock.png"><span>Hora:&nbsp;</span><label id="lbl_hora"></label><br><img src="/images/icon/1336166157_user.png"><span>Usuario:&nbsp;</span><label id="lbl_usuario">'+'<?php echo USER_LOGIN.' - '.NOMBRE;?>'+'</label>&nbsp;</div>'+
                                    '<div class="close"><img src="/images/front/btn_salir.gif" onclick="inicio.expire();"></div>'+
                                '</header>';

                    var vfooter = '<footer>'+
                                    '<div class="fizq"></div>'+
                                '</footer>';

                    Ext.create('Ext.container.Viewport', {
                        layout:'border',
                        padding:'5 5 5 5',
                        border:false,
                        defaults:{
                            border:false
                        },
                        items:[
                            {
                                region:'north',
                                height:60,
                                html:vheader,
                                bodyStyle:'background:transparent',
                                items:[
                                    {
                                        xtype:'panel',
                                        id:'index_web_carga',
                                        hidden:true,
                                        hideMode:'offsets'
                                    }
                                ]
                            },
                            {
                                region:'center',
                                id:inicio.id+'-tabContent',
                                border:false,
                                bodyCls: 'fondo',
                                defaults:{
                                    border: false
                                },
                                layout: 'fit'
                            },
                            {
                                region:'south',
                                height:45,
                                html:vfooter,
                                bodyStyle:'background:transparent'
                            }
                        ],
                        listeners:{
                            afterrender:function(obj){
                                inicio.startTimer();
                                
                            }
                        }
                    });
                },
                getForm:function(vurl){
                    if(!Ext.isEmpty(vurl)){
                        if(vurl.split('.php').length != 2){
                            win.show({vurl:vurl});
                        }else{
                            laroext.Msg({msg:'No existe archivo vinculado al menu.'});
                        }
                    }else{
                        laroext.Msg({msg:'No existe archivo vinculado al menu.'});
                    }
                },
                expire:function(){
                    var vurl = '/login/ingreso/expire/';
                    Ext.Ajax.request({
                        url     :vurl,
                        success :function(response, options){
                            window.location = '/inicio/index/';
                        }
                    });
                },
                startTimer:function(){
                    var task = Ext.TaskManager.start({
                        run: inicio.setTimer,
                        interval: 1000
                    });
                },
                setTimer:function(){
                    var ahora=new Date();
                    var hora=ahora.getHours();
                    var minutos=ahora.getMinutes();
                    var segundos=ahora.getSeconds();
                    var vl_hora = hora+":"+str_pad(String(minutos), 2, '0', 'STR_PAD_LEFT');
                    Ext.fly('lbl_hora').update(hora+":"+str_pad(String(minutos), 2, '0', 'STR_PAD_LEFT')+":"+str_pad(String(segundos), 2, '0', 'STR_PAD_LEFT'));
                }
            }
            Ext.onReady(inicio.init, inicio);
        </script>
    </head>
    <body>

    </body>
</html>