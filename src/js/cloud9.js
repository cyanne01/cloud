window.onlineimg = {};
window.onlineimg.col = 'blue';

function cloud9Load(){
    loadContent('/ajax/home');
};

function cloud9AdminLoad(){
    loadContent('/ajax/admin/home');
};

function loadContent(url){
	$("#content").hide();
	$("#contentloading").show();
	$.get(url, function (data){ $("#content").html(data); $("#contentloading").hide(); $("#content").show(); });
};

function loadContentPost(url, data){
	$("#content").hide();
	$("#contentloading").show();
	$.post(url, data, function (data) { $("#content").html(data); $("#contentloading").hide(); $("#content").show(); });
};
