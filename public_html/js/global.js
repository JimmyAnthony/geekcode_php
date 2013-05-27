/*
 * Desarrollado por: Luis Remicio Obregon
 * Twitter: @remicioluis
 * Gmail: remicioluis@gmail.com
 *--------------------------------------
 * Fecha de desarrollo: 23/05/2013
 * Basado en esquema MVC
 * -------------------------------------
 * Funciones globales
 */

win = {
    request:[],
    modules:[],
    loaded:false,
    getModule:function(v){
        var ms = this.modules;
        for(var i = 0, len = ms.length; i < len; i++){
            if(ms[i].id == v ){
                return ms[i];
            }
        }
        return null;
    },
    loadModuleComplete:function(success, vid){
        if(success === true && vid){
            this.request.push({
                id:vid
            });
        }
    },
    requestModule:function(id){
        var ms = this.request;
        for(var i = 0, len = ms.length; i < len; i++){
            if(id==ms[i].id) return true;
        }
        return false;
    },
    init:function(){
        
    },
    /*
     * Recomendada para desarrollo
     */
    show:function(param){
        this.param = param;
        this.param.vurl=this.param.vurl==undefined?'':this.param.vurl;
        this.param.vwidth=this.param.vwidth==undefined?'':parseInt(this.param.vwidth);
        this.param.vheight=this.param.vheight==undefined?'':parseInt(this.param.vheight);
        this.param.vjs=this.param.vjs==undefined?'':this.param.vjs;
        this.param.title=this.param.title==undefined?this.param.vnombre:this.param.title;
        this.param.mask = this.param.mask==undefined?Ext.getBody():this.param.mask;
        var myMask = new Ext.LoadMask(this.param.mask, {
            msg:"Por favor espere..."
        });
        myMask.show();
        Ext.get('index_web_carga').load({
            url:this.param.vurl,
            scripts:true,
            callback:function(){
                myMask.hide();
            }
        });
    },
    /*
     * Recomendada para produccion
     */
    showx:function(param){
        //console.log(param);
        this.param = param;
        this.param.options = this.param.options==undefined?'':this.param.options;
        this.param.moduleId = this.param.moduleId==undefined?'':this.param.moduleId;
        this.param.vurl=this.param.vurl==undefined?'':this.param.vurl;
        this.param.mask = this.param.mask==undefined?Ext.getBody():this.param.mask;
        var op = this.param.options;
        var vid = this.param.moduleId;
        var myMask = new Ext.LoadMask(this.param.mask, {
            msg:"Por favor espere..."
        });
        this.modules.push({
            id:vid
        });
        var m = this.getModule(vid);
        if(m){
            if(this.requestModule(vid)){
                var javascript = eval(vid);
                javascript.init(op);
            }else{
                myMask.show();
                Ext.get('index_web_carga').load({
                    url:this.param.vurl,
                    scripts:true,
                    callback:function(){
                        myMask.hide();
                        win.loadModuleComplete(true,vid);
                    }
                });
            }
        }
    }
}
var LarSyrExt = function(){
    this.ShowPdf = function(p){
        p.url = p.url==undefined?'/inicio/index/getFormPdf/':p.url;
        p.vurl = p.vurl==undefined?'':p.vurl;
        p.title = p.title==undefined?'Reporte':p.title;
        p.width = p.width==undefined?800:p.width;
        p.heigth = p.heigth==undefined?450:p.heigth;
        p.clos = p.clos==undefined?true:p.clos;
        win.show({
            vurl:p.url+'?vfile='+p.vurl+'&vwidth='+p.width+'&vheigth='+p.heigth+'&title='+p.title,
            mask:'inicio-tabContent'
        });
    };
    this.Msg = function(p){
        var icons = [Ext.Msg.ERROR, Ext.Msg.INFO, Ext.Msg.WARNING, Ext.Msg.QUESTION];
        var button = [Ext.Msg.CANCEL, Ext.Msg.OK, Ext.Msg.OKCANCEL, Ext.Msg.YESNO, Ext.Msg.YESNOCANCEL];
        p.title = p.title==undefined?'.:Sistema de pagos en Línea:.':p.title;
        p.msg = p.title==undefined?'':p.msg;
        p.buttons = p.buttons==undefined?1:p.buttons;
        p.icon = p.icon==undefined?1:p.icon;
        p.fn = p.fn==undefined?false:p.fn;
        Ext.Msg.show({
            title: p.title,
            msg: p.msg,
            buttons: button[p.buttons],
            icon: icons[p.icon],
            fn:p.fn
        });
    };
    this.notification = function(p){
        this.p = p;
        this.p.vtitle = this.p.vtitle == undefined?'Notificacion':this.p.vtitle;
        this.p.vhtml = this.p.vhtml == undefined?'M&oacute;dulos Cargados':this.p.vhtml;
        this.p.vtime = this.p.vtime == undefined?5000:parseInt(this.p.vtime);
        new Ext.ux.Notification({
            title : this.p.vtitle,
            html : this.p.vhtml,
            autoDestroy : true,
            hideDelay : this.p.vtime,
            shadow : false,
            padding : 5
        }).show(Ext.getBody());
    };
    /*
     * Restar horas
     */
    this.substractTimes = function(t1, t2){
        var secs1 = this.stringToSeconds(t1);
        var secs2 = this.stringToSeconds(t2);
        var secsDif = secs1 - secs2;
        return this.secondsToTime(secsDif);
    };

    this.stringToSeconds = function(tiempo){
        var sep1 = tiempo.indexOf(":");
        var sep2 = tiempo.lastIndexOf(":");
        var hor = tiempo.substr(0, sep1);
        var min = tiempo.substr(sep1 + 1, sep2 - sep1 - 1);
        var sec = tiempo.substr(sep2 + 1);
        return (Number(sec) + (Number(min) * 60) + (Number(hor) * 3600));
    }

    this.secondsToTime = function(secs){
        var hor = Math.floor(secs / 3600);
        var min = Math.floor((secs - (hor * 3600)) / 60);
        var sec = secs - (hor * 3600) - (min * 60);
        return str_pad(hor, 2, '0', 'STR_PAD_LEFT') + ":" + str_pad(min, 2, '0', 'STR_PAD_LEFT') + ":" + str_pad(sec, 2, '0', 'STR_PAD_LEFT');
    }

    this.secondsToTimeInt = function(hora){
        var secs = this.stringToSeconds(hora);
        return ( secs / 60 );
    }

    this.substractTimesInt = function(t1, t2){
        var secs1 = this.stringToSeconds(t1);
        var secs2 = this.stringToSeconds(t2);
        var secsDif = secs1 - secs2;
        return secsDif;
    };

    this.close_panel = function(){
        var panel = Ext.getCmp(inicio.id+'-tabContent');
        panel.removeAll();
        panel.update('<div class="logo_gris"></div>');
    }
}

function str_pad (input, pad_length, pad_string, pad_type) {
    // Returns input string padded on the left or right to specified length with pad_string  
    // 
    // version: 1109.2015
    // discuss at: http://phpjs.org/functions/str_pad
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + namespaced by: Michael White (http://getsprink.com)
    // +      input by: Marco van Oort
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: str_pad('Kevin van Zonneveld', 30, '-=', 'STR_PAD_LEFT');
    // *     returns 1: '-=-=-=-=-=-Kevin van Zonneveld'
    // *     example 2: str_pad('Kevin van Zonneveld', 30, '-', 'STR_PAD_BOTH');
    // *     returns 2: '------Kevin van Zonneveld-----'
    var half = '',
        pad_to_go;
 
    var str_pad_repeater = function (s, len) {
        var collect = '',
            i;
 
        while (collect.length < len) {
            collect += s;
        }
        collect = collect.substr(0, len);
 
        return collect;
    };
 
    input += '';
    pad_string = pad_string !== undefined ? pad_string : ' ';
 
    if (pad_type != 'STR_PAD_LEFT' && pad_type != 'STR_PAD_RIGHT' && pad_type != 'STR_PAD_BOTH') {
        pad_type = 'STR_PAD_RIGHT';
    }
    if ((pad_to_go = pad_length - input.length) > 0) {
        if (pad_type == 'STR_PAD_LEFT') {
            input = str_pad_repeater(pad_string, pad_to_go) + input;
        } else if (pad_type == 'STR_PAD_RIGHT') {
            input = input + str_pad_repeater(pad_string, pad_to_go);
        } else if (pad_type == 'STR_PAD_BOTH') {
            half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
            input = half + input + half;
            input = input.substr(0, pad_length);
        }
    }
 
    return input;
}

function json_encode (mixed_val) {
  // http://kevin.vanzonneveld.net
  // +      original by: Public Domain (http://www.json.org/json2.js)
  // + reimplemented by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      improved by: Michael White
  // +      input by: felix
  // +      bugfixed by: Brett Zamir (http://brett-zamir.me)
  // *        example 1: json_encode(['e', {pluribus: 'unum'}]);
  // *        returns 1: '[\n    "e",\n    {\n    "pluribus": "unum"\n}\n]'
/*
    http://www.JSON.org/json2.js
    2008-11-19
    Public Domain.
    NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK.
    See http://www.JSON.org/js.html
  */
  var retVal, json = this.window.JSON;
  try {
    if (typeof json === 'object' && typeof json.stringify === 'function') {
      retVal = json.stringify(mixed_val); // Errors will not be caught here if our own equivalent to resource
      //  (an instance of PHPJS_Resource) is used
      if (retVal === undefined) {
        throw new SyntaxError('json_encode');
      }
      return retVal;
    }

    var value = mixed_val;

    var quote = function (string) {
      var escapable = /[\\\"\u0000-\u001f\u007f-\u009f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;
      var meta = { // table of character substitutions
        '\b': '\\b',
        '\t': '\\t',
        '\n': '\\n',
        '\f': '\\f',
        '\r': '\\r',
        '"': '\\"',
        '\\': '\\\\'
      };

      escapable.lastIndex = 0;
      return escapable.test(string) ? '"' + string.replace(escapable, function (a) {
        var c = meta[a];
        return typeof c === 'string' ? c : '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
      }) + '"' : '"' + string + '"';
    };

    var str = function (key, holder) {
      var gap = '';
      var indent = '    ';
      var i = 0; // The loop counter.
      var k = ''; // The member key.
      var v = ''; // The member value.
      var length = 0;
      var mind = gap;
      var partial = [];
      var value = holder[key];

      // If the value has a toJSON method, call it to obtain a replacement value.
      if (value && typeof value === 'object' && typeof value.toJSON === 'function') {
        value = value.toJSON(key);
      }

      // What happens next depends on the value's type.
      switch (typeof value) {
      case 'string':
        return quote(value);

      case 'number':
        // JSON numbers must be finite. Encode non-finite numbers as null.
        return isFinite(value) ? String(value) : 'null';

      case 'boolean':
      case 'null':
        // If the value is a boolean or null, convert it to a string. Note:
        // typeof null does not produce 'null'. The case is included here in
        // the remote chance that this gets fixed someday.
        return String(value);

      case 'object':
        // If the type is 'object', we might be dealing with an object or an array or
        // null.
        // Due to a specification blunder in ECMAScript, typeof null is 'object',
        // so watch out for that case.
        if (!value) {
          return 'null';
        }
        if ((this.PHPJS_Resource && value instanceof this.PHPJS_Resource) || (window.PHPJS_Resource && value instanceof window.PHPJS_Resource)) {
          throw new SyntaxError('json_encode');
        }

        // Make an array to hold the partial results of stringifying this object value.
        gap += indent;
        partial = [];

        // Is the value an array?
        if (Object.prototype.toString.apply(value) === '[object Array]') {
          // The value is an array. Stringify every element. Use null as a placeholder
          // for non-JSON values.
          length = value.length;
          for (i = 0; i < length; i += 1) {
            partial[i] = str(i, value) || 'null';
          }

          // Join all of the elements together, separated with commas, and wrap them in
          // brackets.
          v = partial.length === 0 ? '[]' : gap ? '[\n' + gap + partial.join(',\n' + gap) + '\n' + mind + ']' : '[' + partial.join(',') + ']';
          gap = mind;
          return v;
        }

        // Iterate through all of the keys in the object.
        for (k in value) {
          if (Object.hasOwnProperty.call(value, k)) {
            v = str(k, value);
            if (v) {
              partial.push(quote(k) + (gap ? ': ' : ':') + v);
            }
          }
        }

        // Join all of the member texts together, separated with commas,
        // and wrap them in braces.
        v = partial.length === 0 ? '{}' : gap ? '{\n' + gap + partial.join(',\n' + gap) + '\n' + mind + '}' : '{' + partial.join(',') + '}';
        gap = mind;
        return v;
      case 'undefined':
        // Fall-through
      case 'function':
        // Fall-through
      default:
        throw new SyntaxError('json_encode');
      }
    };

    // Make a fake root object containing our value under the key of ''.
    // Return the result of stringifying the value.
    return str('', {
      '': value
    });

  } catch (err) { // Todo: ensure error handling above throws a SyntaxError in all cases where it could
    // (i.e., when the JSON global is not available and there is an error)
    if (!(err instanceof SyntaxError)) {
      throw new Error('Unexpected error type in json_encode()');
    }
    this.php_js = this.php_js || {};
    this.php_js.last_error_json = 4; // usable by json_last_error()
    return null;
  }
}

var laroext = new LarSyrExt();