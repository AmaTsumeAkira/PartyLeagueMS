
<?php
    $pageTitle = "班级管理"; // 设置页面标题
    $qxyq = "1"; // 设置权限
    // 1=超级管理员
    // 2=党务、团务、学生会管理员
    // 3=团务、学生会管理员
    // 4=学生会管理员
    // 5=各级团支书
    // 其他页面逻辑和内容
    include '..\sub\qxpd.php'; // 包含页眉文件
?>


<?php
// admin\index.php

// 导入配置文件
require_once('..\controller\.config');

// 连接数据库
$conn = new mysqli($host, $username, $password, $database);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 添加班级
if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    $stmt = $conn->prepare("INSERT INTO class (username, password, user_type) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $user_type);
    if ($stmt->execute()) {
        echo "班级添加成功。";
    } else {
        echo "添加班级时出错：" . $conn->error;
    }
}

// 删除班级
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];

    $stmt = $conn->prepare("DELETE FROM class WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        echo "班级删除成功。";
    } else {
        echo "删除班级时出错：" . $conn->error;
    }
}

// 修改班级
if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    $stmt = $conn->prepare("UPDATE class SET username = ?, password = ?, user_type = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $password, $user_type, $user_id);
    if ($stmt->execute()) {
        echo "班级更新成功。";
    } else {
        echo "更新班级时出错：" . $conn->error;
    }
}

// 查找班级
if (isset($_POST['search_user'])) {
    $search_username = $_POST['search_username'];

    $stmt = $conn->prepare("SELECT id, username, user_type FROM class WHERE username LIKE ?");
    $search_username = "%" . $search_username . "%";
    $stmt->bind_param("s", $search_username);
    $stmt->execute();
    $stmt->bind_result($id, $username, $user_type);

    echo "<h2>Search Results:</h2>";
    echo "<ul>";
    while ($stmt->fetch()) {
        echo "<li>User ID: $id, Username: $username, User Type: $user_type</li>";
    }
    echo "</ul>";
}

// 获取所有班级列表
$stmt = $conn->prepare("SELECT id, username, password, user_type FROM class");
$stmt->execute();
$stmt->bind_result($id, $username, $password, $user_type);

$total_classes = 0;
$user_type_total = 0;
$ungraduated_count = 0;
$ungraduated_user_type_total = 0;

// 遍历结果集
while ($stmt->fetch()) {
    // 计算班级总数
    $total_classes++;

    // 计算 user_type 相加的总数量
    $user_type_total += $user_type;

    // 计算 password 筛选为 ”未毕业“ 的数量
    if ($password == "未毕业") {
        $ungraduated_count++;
        $ungraduated_user_type_total += $user_type; // 累加未毕业班级的user_type
    }
}

// 获取所有班级列表
$stmt = $conn->prepare("SELECT id, username, password, user_type FROM class");
$stmt->execute();
$stmt->bind_result($id, $username, $password, $user_type);
?>
<?php
$pageTitle = "班级管理"; // 设置页面标题
// 其他页面逻辑和内容
include '..\sub\head.php'; // 包含页眉文件
?>


<script src="../tabler/dist/js/demo-theme.min.js?1684106062"></script>
<div class="page">
    <!-- Navbar -->
    <?php
    include '..\sub\bodyhead.php';
    include './menu.php';
    ?>
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            管理员同志！欢迎您！
                        </h2>
                    </div>
                </div>
            </div>
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="container-xl">
                        <div class="row row-deck row-cards">
                            <div class="col-4">


                                <form class="card" method="post" action="">
                                    <div class="card-header">
                                        <h4 class="card-title">添加班级</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">班级名</label>
                                            <div class="col">
                                                <input type="text" name="username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">状态</label>
                                            <div class="col">
                                                <select name="password" class="form-control">
                                                    <option value="未毕业">未毕业</option>
                                                    <option value="已毕业">已毕业</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">班级人数</label>
                                            <div class="col">
                                                <input type="text" name="user_type" class="form-control">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary" name="add_user"
                                            value="Add User">添加班级</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4">
                                <form class="card" method="post" action="">
                                    <div class="card-header">
                                        <h4 class="card-title">修改班级</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">班级ID</label>
                                            <div class="col">
                                                <input type="text" name="user_id" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">班级名</label>
                                            <div class="col">
                                                <input type="text" name="username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">状态</label>
                                            <div class="col">
                                                <select name="password" class="form-control">
                                                    <option value="未毕业">未毕业</option>
                                                    <option value="已毕业">已毕业</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">班级人数</label>
                                            <div class="col">
                                                <input type="text" name="user_type" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary" name="update_user"
                                            value="Update User">修改班级</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <!-- <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a href="#tabs-home-5" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">班级人数说明</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a href="#tabs-profile-5" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">配置说明</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a href="#tabs-activity-5" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">其他</a>
                      </li>
                    </ul> -->
                                        <h4 class="card-title">数据概览</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active show" id="tabs-home-5" role="tabpanel">
                                                <div class="row row-cards">
                                                    <div class="col-12">
                                                        <div class="card card-sm">
                                                            <div class="card-body">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <span class="avatar">班级</span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="font-weight-medium">
                                                                            共
                                                                            <?php echo "$total_classes\n"; ?>个班级
                                                                        </div>
                                                                        <div class="text-muted">
                                                                            系统内总班级数量
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="card card-sm">
                                                            <div class="card-body">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <span class="avatar">人数</span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="font-weight-medium">
                                                                            共
                                                                            <?php echo "$ungraduated_user_type_total\n"; ?>人
                                                                        </div>
                                                                        <div class="text-muted">
                                                                            未毕业学生总人数
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="card card-sm">
                                                            <div class="card-body">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <span class="avatar">未毕业</span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="font-weight-medium">
                                                                            共
                                                                            <?php echo "$ungraduated_count\n"; ?>人
                                                                        </div>
                                                                        <div class="text-muted">
                                                                            未毕业班级总数
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabs-profile-5" role="tabpanel">
                                                <h4>配置说明</h4>
                                                <div>0000</div>
                                            </div>
                                            <div class="tab-pane" id="tabs-activity-5" role="tabpanel">
                                                <h4>其他</h4>
                                                <div>000</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title" _msttexthash="20093437" _msthash="306">班级列表</h3>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th>班级ID</th>
                                                    <th>班级名</th>
                                                    <th>班级状态</th>
                                                    <th>班级人数</th>
                                                    <th>删除操作</th>
                                                    <th class="w-1"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($stmt->fetch()) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $id; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $username; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $password; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $user_type; ?>
                                                        </td>
                                                        <td><a href="?delete_user=<?php echo $id; ?>"
                                                                class="btn btn-danger">Delete</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <?php
    include '..\sub\footer.php'; // 包含页脚文件
    ?>

    <?php
    // 关闭数据库连接
    $stmt->close();
    $conn->close();
    ?>