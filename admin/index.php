  <?php 
  require_once'../functions.php';
    // 校验数据当前访问用户的 箱子（session）有没有登录的登录标识
    xiu_get_current_user();
  //文章总数
   $count_posts=xiu_fetch_one('select count(1) as num from posts;')['num'];
   //分类总数
   $count_categories=xiu_fetch_one('select count(1) as num from categories;')['num'];
   //已发布条数
   $count_possts_published=xiu_fetch_one("select count(1) as num from posts where status like'published%'")['num'];
   //草稿数
  $count_possts_drafted=xiu_fetch_one("select count(1) as num from posts where status like'drafted%'")['num'];
  // 查询回收站总数
  $count_possts_trashed= xiu_fetch_one("select count(1) as num from posts where status like'trashed%'")['num'];

   ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
 <?php include 'inc/navbar.php' ?>
    <div class="container-fluid">
      <div class="jumbotron text-center">
        <h1>One Belt, One Road</h1>
        <p>Thoughts, stories and ideas.</p>
        <p><a class="btn btn-primary btn-lg" href="post-add.php" role="button">写文章</a></p>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">站点内容统计：</h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item"><strong><?php echo $count_posts; ?></strong>篇文章</li>
              <li class="list-group-item"><strong><?php echo $count_possts_drafted; ?></strong>个草稿</li>
              <li class="list-group-item"><strong><?php echo  $count_possts_published; ?></strong>条已发布（<strong><?php echo $count_possts_trashed; ?></strong>条回收站）</li>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
            <canvas id="chart" class="chartjs" width="619" height="309" style="display: block; width: 619px; height: 309px;"></canvas>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>

 <?php $current_page='index'; ?>
 <?php include 'inc/sidebar.php';?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/static/assets/vendors/chart/Chart.js"></script>
  <script>NProgress.done()</script>
 <script>
      new Chart(document.getElementById("chart"),
      {"type":"polarArea",
      "data":
            {"labels":["文章","草稿","已发布"],
            "datasets":[{"label":"数量",
            "data":[<?php echo $count_posts; ?>,<?php echo $count_possts_drafted; ?>,<?php echo  $count_possts_published; ?>],
            "backgroundColor":[
            "rgb(255, 99, 132)",
            "rgb(75, 192, 192)",
            "rgb(255, 205, 86)",
            ]}
            ]
          }
        });
</script>
</body>
</html>
