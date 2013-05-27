/**
 * @class Ext.global.nroexpediente
 * @extends Ext.form.Panel
 * @author Luis Remicio
 */
Ext.define('Ext.global.nroexpediente', {
	extend: 'Ext.form.FieldContainer',
	alias: 'widget.nroexpediente',
	border: false,
	layout:{
		type: 'hbox'
	},
	initComponent: function(){
		var me = this;

		me.defaults = {
			style:{
				marginRight: '1px'
			},
			xtype: 'textfield',
			enforceMaxLength: true,
			maskRe: /\d/,
			enableKeyEvents: true,
			allowBlank: me.allowBlank == undefined ? true : false,
			listeners:{
				blur: function(obj, evt, opts){
					obj.setValue(Ext.String.leftPad(obj.getValue(), obj.maxLength, '0'));
				}
			}
		};

		me.items = [
			{
				id: me.id+'-expe_p1',
				maxLength: 3,
				width: 30
			},
			{
				id: me.id+'-expe_p2',
				maxLength: 3,
				width: 30
			},
			{
				id: me.id+'-expe_p3',
				maxLength: 5,
				width: 50
			},
			{
				xtype: 'displayfield',
				value: '-'
			},
			{
				id: me.id+'-expe_p4',
				maxLength: 4,
				width: 40
			}
		];

		this.callParent();
	},
	getExpediente: function(){
		var me = this;
		var p1 = Ext.getCmp(me.id+'-expe_p1').getValue();
		var p2 = Ext.getCmp(me.id+'-expe_p2').getValue();
		var p3 = Ext.getCmp(me.id+'-expe_p3').getValue();
		var p4 = Ext.getCmp(me.id+'-expe_p4').getValue();
		return (p1+''+p2+''+p3+'-'+p4);
	},
	clearValues: function(){
		var me = this;
		Ext.getCmp(me.id+'-expe_p1').setValue('');
		Ext.getCmp(me.id+'-expe_p2').setValue('');
		Ext.getCmp(me.id+'-expe_p3').setValue('');
		Ext.getCmp(me.id+'-expe_p4').setValue('');
	}
});