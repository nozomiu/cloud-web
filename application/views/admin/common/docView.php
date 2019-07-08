<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>FlexPaper</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width" />
    <style type="text/css" media="screen">
        html, body  { height:100%; }
        body { margin:0; padding:0; overflow:auto; }
        #flashContent { display:none; }
    </style>

    <link rel="stylesheet" type="text/css" href="/static/css/flexpaper.css" />
    <script type="text/javascript" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/flexpaper.js"></script>
    <script type="text/javascript" src="/static/js/flexpaper_handlers.js"></script>
    <script type="text/javascript" src="/static/js/dms/docView.js"></script>
    <script type="text/javascript" src="/static/js/dms/action.js"></script>
</head>
<body>
<div id="documentViewer" class="flexpaper_viewer" style="position:absolute;"></div>
<script type="text/javascript">
    $(document).ready(function(){
        var id = '<? echo $this->input->get('id');?>';
        var revId = '<? echo $this->input->get('revId');?>';
        console.log("id :"+ id);
        if(id == '') {
            return;
        }
        docViewObj.preView(id,revId,<? echo $this->input->get('token');?>,<? echo $this->input->get('sessionId');?>);
    });
</script>
</body>
</html>