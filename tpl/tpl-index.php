<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= SITE_TITLE ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
    <div class="pageHeader">
        <div class="title">Dashboard</div>
        <div class="userPanel">
            <a href="<?= site_url("?logout=".$user->id)?>"><i class="fa fa-sign-out"></i></a>
            <span class="username"><?=$user->name ?getLoggInUser()->name : "unknownUser"?></span><img
                    src="<?= BASE_URL ?>/assets/img/team2.jpg" width="40" height="40"/></div>
    </div>
    <div class="main">
        <div class="nav">
            <div class="searchbox">
                <div><i class="fa fa-search"></i>
                    <input type="search" placeholder="Search"/>
                </div>
            </div>
            <div class="menu">
                <div class="title">Folders</div>
                <ul class="folderList">
                    <li class="<?= ($folder->id == $_GET['folder_id'])?'active':null ?>">
                        <a href="?folder_id="><i class="fa fa-folder"></i>All
                        </a>
                    </li>
                    <?php foreach ($folders as $folder) : ?>
                        <li class="<?= ($folder->id == $_GET['folder_id'])?'active':null ?>">
                            <a href="?folder_id=<?= $folder->id ?>">
                                <i class="fa fa-folder"></i><?= $folder->name ?>
                            </a>
                            <a href="?delete_folder=<?= $folder->id ?>" onclick="return confirm('Are You Sure to Delete This Item');">
                                <i style="float: right;color: red" class="fa fa-trash-o"></i>
                            </a>
                        </li>

                    <?php endforeach; ?>

                </ul>
                <div class="searchbox" style="margin:6px;">
                    <input type="text" id="addFolderInput" placeholder="Add New Folder"/>
                    <button id="addFolderBtn" class="clickable">+</button>
                </div>


            </div>
        </div>
        <div class="view">
            <div class="viewHeader">
                <div class="searchbox" style="margin:6px;">
                    <input type="text" id="addTaskInput" placeholder="Add New Task"/>
                  <!--  <button id="addTaskBtn" class="clickable">+</button>-->
                </div>
              <!--  <div class="functions">
                    <div class="button active">Add New Task</div>
                    <div class="button">Completed</div>
                    <div class="button inverz"><i class="fa fa-trash-o"></i></div>
                </div>-->
            </div>
            <div class="content">
                <div class="list">
                    <div class="title">Today</div>
                    <ul>
                        <?php if (sizeof($tasks) > 0):?>
                        <?php foreach ($tasks as $task):?>
                            <li class="<?=$task->is_done?'checked':' ' ;?>">
                                <i class="fa <?=$task->is_done?'fa-check-square-o':'fa-square-o' ;?>"></i>
                                <span><?=$task->title?></span>
                                <div class="info">
                                    <span class="created-at">created_at <?=$task->created_at?></span>
                                    <a href="?delete_task=<?=$task->id?>" onclick="return confirm('Are You Sure to Delete This Item');">
                                        <i style="float: right;color: red" class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </li>
                        <?php endforeach;?>
                        <?php else: ?>
                        <li>No Task Here ... </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'>

</script>
<script src="<?= BASE_URL ?>assets/js/script.js"></script>
<script>
    $(document).ready(function () {
        $('#addFolderBtn').click(function () {
            //let name = document.getElementById('addFolderInput').value;
            var name = $('input#addFolderInput').val();
            console.log(name)
            $.ajax({
                url: "process/ajaxHandler.php",
                data: {action: "addFolder", folderName: name},
                method: "post",
                success: function (response) {
                    if (response == '1') {
                        $('<li> <a href="#"><i class="fa fa-folder"></i>' + name +
                            ' </a></li>').appendTo('ul.folderList');

                    }
                },
            });
        })

        $('#addTaskInput').on('keypress',function(event) {
            if (event.which == 13) {
                var title = $('input#addTaskInput').val();
                var folderId = <?= isset($_GET['folder_id']) ?  $_GET['folder_id']: null;?>
                $.ajax({
                    url: "process/ajaxHandler.php",
                    data: {action: "addTask", taskName: title,folder_id:folderId},
                    method: "post",
                    success: function (response) {

                        if (response == '1') {
                            location.reload();
                        }else{
                            alert(response)
                        }
                    },
                });
            }
        });
    })
</script>
</body>
</html>
