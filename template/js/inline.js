//Ano
$(function ()
{
    var sel = $("#sel"),
	ano = "kon",
	chif = $("#chiff"),
    allFields = $([]).add(sel).add(chif),
    tips = $(".validateTips");

    function updateTips(t)
    {
        tips
        .text(t)
        .addClass("ui-state-highlight");
        setTimeout(function ()
        {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }
    $("#dialog-formSel").dialog({
        autoOpen: false,
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Speichern": function ()
            {
                $.post('save.php', {value:sel.val(),chiff:chif.val(), field:ano},
				function (data) {
				$("#dialog-formSel").html(data);
                window.location.href="http://hsh.nolimitgerman.de/index.php?site=req";
            allFields.val("").removeClass("ui-state-error");	
				});
            },
            Cancel: function ()
            {
                $(this).dialog("close");
            }
        },
        close: function ()
        {
			window.location.href="http://hsh.nolimitgerman.de/index.php?site=req";
            allFields.val("").removeClass("ui-state-error");
        }
    });
    	$(".button")
		.button()
		.click(function ()
		{
			$("#dialog-formSel").dialog("open");
      });
});
//Datum und Uhrzeit
$(function ()
{
    var sel = $("#seldat"),
    seluhr = $("#seluhr"),
    selmin = $("#seluhrm"),
	ano = "dat",
	chif = $("#chiffdat"),
    allFields = $([]).add(sel).add(chif).add(seluhr).add(selmin),
    tips = $(".validateTips");

    function updateTips(t)
    {
        tips
        .text(t)
        .addClass("ui-state-highlight");
        setTimeout(function ()
        {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }
    $("#dialog-formdat").dialog({
        autoOpen: false,
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Speichern": function ()
            {
                $.post('save.php', {value:sel.val(),chiff:chif.val(), field:ano, datu:seluhr.val(), mini:selmin.val()},
				function (data) {
				$("#dialog-formdat").html(data);
                window.location.href="http://hsh.nolimitgerman.de/index.php?site=req";
            allFields.val("").removeClass("ui-state-error");	
				});
            },
            Cancel: function ()
            {
                $(this).dialog("close");
            }
        },
        close: function ()
        {
			window.location.href="http://hsh.nolimitgerman.de/index.php?site=req";
            allFields.val("").removeClass("ui-state-error");
        }
    });
    	$(".buttondat")
		.button()
		.click(function ()
		{
			$("#dialog-formdat").dialog("open");
      });
});
// ZIP
$(function ()
{
    var sel = $("#selort"),
	ano = "port",
	chif = $("#chiffort"),
    allFields = $([]).add(sel).add(chif),
    tips = $(".validateTips");

    function updateTips(t)
    {
        tips
        .text(t)
        .addClass("ui-state-highlight");
        setTimeout(function ()
        {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }
    $("#dialog-formort").dialog({
        autoOpen: false,
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Speichern": function ()
            {
                $.post('save.php', {value:sel.val(),chiff:chif.val(), field:ano},
				function (data) {
				$("#dialog-formort").html(data);
                window.location.href="http://hsh.nolimitgerman.de/index.php?site=req";
            allFields.val("").removeClass("ui-state-error");	
				});
            },
            Cancel: function ()
            {
                $(this).dialog("close");
            }
        },
        close: function ()
        {
            allFields.val("").removeClass("ui-state-error");
        }
    });
    	$(".buttonort")
		.button()
		.click(function ()
		{
			$("#dialog-formort").dialog("open");
      });
});
//Text 1
$(function ()
{
    var sel = $("#txt"),
	ano = "wo",
	chif = $("#chifftxt"),
    allFields = $([]).add(sel).add(chif),
    tips = $(".validateTips");

    function updateTips(t)
    {
        tips
        .text(t)
        .addClass("ui-state-highlight");
        setTimeout(function ()
        {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }
    $("#dialog-formtxt").dialog({
        autoOpen: false,
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Speichern": function ()
            {
                $.post('save.php', {value:sel.val(),chiff:chif.val(), field:ano},
				function (data) {
				$("#dialog-formtxt").html(data);
                window.location.href="http://hsh.nolimitgerman.de/index.php?site=req";
            allFields.val("").removeClass("ui-state-error");	
				});
            },
            Cancel: function ()
            {
                $(this).dialog("close");
            }
        },
        close: function ()
        {
            allFields.val("").removeClass("ui-state-error");
        }
    });
    	$(".buttontxt")
		.button()
		.click(function ()
		{
			$("#dialog-formtxt").dialog("open");
      });
});
//Text 2
$(function ()
{
    var sel = $("#txts"),
	ano = "ws",
	chif = $("#chifftxts"),
    allFields = $([]).add(sel).add(chif),
    tips = $(".validateTips");

    function updateTips(t)
    {
        tips
        .text(t)
        .addClass("ui-state-highlight");
        setTimeout(function ()
        {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }
    $("#dialog-formtxts").dialog({
        autoOpen: false,
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Speichern": function ()
            {
                $.post('save.php', {value:sel.val(),chiff:chif.val(), field:ano},
				function (data) {
				$("#dialog-formtxts").html(data);
                window.location.href="http://hsh.nolimitgerman.de/index.php?site=req";
            allFields.val("").removeClass("ui-state-error");	
				});
            },
            Cancel: function ()
            {
                $(this).dialog("close");
            }
        },
        close: function ()
        {
            allFields.val("").removeClass("ui-state-error");
        }
    });
    	$(".buttonsecond")
		.button()
		.click(function ()
		{
			$("#dialog-formtxts").dialog("open");
      });
});
//Text 3
$(function ()
{
    var sel = $("#txtt"),
	ano = "wse",
	chif = $("#chifftxtt"),
    allFields = $([]).add(sel).add(chif),
    tips = $(".validateTips");

    function updateTips(t)
    {
        tips
        .text(t)
        .addClass("ui-state-highlight");
        setTimeout(function ()
        {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }
    $("#dialog-formtxtt").dialog({
        autoOpen: false,
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Speichern": function ()
            {
                $.post('save.php', {value:sel.val(),chiff:chif.val(), field:ano},
				function (data) {
				$("#dialog-formtxtt").html(data);
                window.location.href="http://hsh.nolimitgerman.de/index.php?site=req";
            allFields.val("").removeClass("ui-state-error");	
				});
            },
            Cancel: function ()
            {
                $(this).dialog("close");
            }
        },
        close: function ()
        {
            allFields.val("").removeClass("ui-state-error");
        }
    });
    	$(".buttonthird")
		.button()
		.click(function ()
		{
			$("#dialog-formtxtt").dialog("open");
      });
});
//Text 4
$(function ()
{
    var sel = $("#txtf"),
	ano = "wh",
	chif = $("#chifftxtf"),
    allFields = $([]).add(sel).add(chif),
    tips = $(".validateTips");

    function updateTips(t)
    {
        tips
        .text(t)
        .addClass("ui-state-highlight");
        setTimeout(function ()
        {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }
    $("#dialog-formtxtf").dialog({
        autoOpen: false,
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Speichern": function ()
            {
                $.post('save.php', {value:sel.val(),chiff:chif.val(), field:ano},
				function (data) {
				$("#dialog-formtxtf").html(data);
                window.location.href="http://hsh.nolimitgerman.de/index.php?site=req";
            allFields.val("").removeClass("ui-state-error");	
				});
            },
            Cancel: function ()
            {
                $(this).dialog("close");
            }
        },
        close: function ()
        {
            allFields.val("").removeClass("ui-state-error");
        }
    });
    	$(".buttonfour")
		.button()
		.click(function ()
		{
			$("#dialog-formtxtf").dialog("open");
      });
});
//Löschen
$(function ()
{
    var ano = "del",
	chif = $("#chiffdel"),
    allFields = $([]).add(chif),
    tips = $(".validateTips");

    function updateTips(t)
    {
        tips
        .text(t)
        .addClass("ui-state-highlight");
        setTimeout(function ()
        {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }
    $("#dialog-formdel").dialog({
        autoOpen: false,
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Löschen": function ()
            {
                $.post('save.php', {chiff:chif.val(), field:ano},
				function (data) {
				$("#dialog-formdel").html(data);
                window.location.href="http://hsh.nolimitgerman.de/index.php?site=req";
            allFields.val("").removeClass("ui-state-error");	
				});
            },
            Cancel: function ()
            {
                $(this).dialog("close");
            }
        },
        close: function ()
        {
            allFields.val("").removeClass("ui-state-error");
        }
    });
    	$(".buttondel")
		.button()
		.click(function ()
		{
			$("#dialog-formdel").dialog("open");
      });
});
//PMN
$(function ()
{
    var uid = $("#userid"),
	uids = $("#uids"),
	betre = $("#pmbetr"),
	chif = $("#pmnn"),
    allFields = $([]).add(uid).add(uids).add(betre).add(chif),
    tips = $(".validateTips");

    function updateTips(t)
    {
        tips
        .text(t)
        .addClass("ui-state-highlight");
        setTimeout(function ()
        {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }
    $("#dialog-formpnn").dialog({
        autoOpen: false,
        height: 500,
        width: 500,
        modal: true,
        buttons: {
            "Speichern": function ()
            {
                $.post('pmn.php', {uid:uid.val(),uids:uids.val(), betre:betre.val(), chif:chif.val()},
				function (data) {
				$("#dialog-formpnn").html(data);
				alert(data);
                window.location.href="./index.php?site=pm&user="+uid.val(),"";
            allFields.val("").removeClass("ui-state-error");	
				});
            },
            Cancel: function ()
            {
                $(this).dialog("close");
            }
        },
        close: function ()
        {
            allFields.val("").removeClass("ui-state-error");
        }
    });
    	$(".buttonpnn")
		.button()
		.click(function ()
		{
			$("#dialog-formpnn").dialog("open");
      });
});