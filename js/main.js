/**
 * Created by ak-hyeon-chal on 17/2/22.
 */
$(document).ready(function() {

    var totalRow = 0;
    var count = 0;
    $('#TableScore').find('tr').each(function() {
        $(this).find('#score').each(function(){
            totalRow += parseFloat($(this).text());
            count++;
        });
    });if(count!=0)
        totalRow/=count;
    $('#ascore').text('平均分:'+totalRow);

}
);
function inputName(inputid,o) {
    var input=document.getElementById(inputid);
    input.value=o.innerHTML;
}//end inputName
function merge(tableId,col) {
    var tr = document.getElementById(tableId);
    for (var i = 1; i < tr.rows.length; i++) {                //表示数据内容的第二行
        if (tr.rows[i].cells[col].innerHTML == tr.rows[i - 1].cells[col].innerHTML) {//col代表列
            t = i - 1;
            while (tr.rows[i].cells[col].innerHTML == tr.rows[t].cells[col].innerHTML) {
                tr.rows[i].cells[col].style.display = "none";
                if (tr.rows[t].cells[col].rowSpan <= (i - t)) {
                    tr.rows[t].cells[col].rowSpan += 1;      //设置前一行的rowspan+1
                }
                if (i != tr.rows.length - 1)
                    i++;
                else {
                    break;
                }
            }
        }
    }
}//end merge
function unmerge(tableId,col) {
    var tr = document.getElementById(tableId);
    for (var i = 1; i < tr.rows.length; i++) {                //表示数据内容的第二行
        if (tr.rows[i].cells[col].rowSpan!=1) {//col代表列
            t =tr.rows[i].cells[col].rowSpan;
            tr.rows[i].cells[col].rowSpan=1;
            for(;t>1;t--){
                tr.rows[i+t-1].cells[col].style.display="table-cell";
            }

        }
    }
}//end unmerge
(function($){
    //插件
    $.extend($,{
        //命名空间
        sortTable:{
            sort:function(tableId,Idx){
                var table = document.getElementById(tableId);
                var tbody = table.tBodies[0];
                var tr = tbody.rows;

                var trValue = [];
                for (var i=0; i<tr.length; i++ ) {
                    trValue[i] = tr[i];  //将表格中各行的信息存储在新建的数组中
                }

                if (tbody.sortCol == Idx) {
                    trValue.reverse(); //如果该列已经进行排序过了，则直接对其反序排列
                } else {
                    //trValue.sort(compareTrs(Idx));  //进行排序
                    trValue.sort(function(tr1, tr2){
                        var value1 = tr1.cells[Idx].innerHTML;
                        var value2 = tr2.cells[Idx].innerHTML;
                        return value1.localeCompare(value2);
                    });
                }

                var fragment = document.createDocumentFragment();  //新建一个代码片段，用于保存排序后的结果
                for (var i=0; i<trValue.length; i++ ) {
                    fragment.appendChild(trValue[i]);
                }

                tbody.appendChild(fragment); //将排序的结果替换掉之前的值
                tbody.sortCol = Idx;
            }
        }
    });
})(jQuery);//排序

var xmlHttp;

function showHint(str)
{
    xmlHttp=GetXmlHttpObject();
    if (xmlHttp==null)
    {
        alert ("Browser does not support HTTP Request");
        return
    }
    var url="getGrade.php";
    url=url+"?col="+str;
    url=url+"&sid="+Math.random();
    xmlHttp.onreadystatechange=stateChanged;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null)
}

function stateChanged()
{
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    {
        document.getElementById("TeacherList").innerHTML=xmlHttp.responseText
    }
}

function GetXmlHttpObject()
{
    var xmlHttp=null;
    try
    {
        // Firefox, Opera 8.0+, Safari
        xmlHttp=new XMLHttpRequest();
    }
    catch (e)
    {
        // Internet Explorer
        try
        {
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}

function getaverage() {
    window.location="admin.php?class=count&col="+document.getElementById("InputCol").value+"&grade="+document.getElementById("InputGrade").value;
}