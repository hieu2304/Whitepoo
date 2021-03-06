<?php
    require_once('init.php');
    $posts = null;
    $privacy = getPrivacy();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Trang cá nhân - WhiteFoo</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/status.css">
    <link rel="stylesheet" href="assets/css/Modal.css">
    <link rel="stylesheet" href="assets/css/spinners/style.css">
</head>

<body>
    <div>
        <div class="header-blue">
            <?php include '_nav.php'; ?>
            <script>getURL();</script>
            <div id="content">
                <?php if (!isset($_SESSION['profileID'])) : ?>
                        <div class="container hero">
                            <div class="row">
                                <div class="col-12 col-lg-6 col-xl-5 offset-xl-1">
                                    <h1>ĐĂNG NHẬP ĐỂ TIẾP TỤC</h1>
                                    <button class="btn btn-light btn-lg action-button" type="button" Onclick="window.location.href='register.php'">Chưa có tài khoản? Đăng ký ngay</button></div>
                                <div
                                    class="col-md-5 col-lg-5 offset-lg-1 offset-xl-0 d-none d-lg-block phone-holder">
                                    <div class="center-img">
                                        <img class="lazyload blur-up" data-src="assets\img\fox-1284512_1920.jpg" src="assets\img\fox-1284512_placeholder.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php else : ?>
                    <?php if (!isset($_GET['id']) || $_GET['id'] == $currentUser['profileID']) : ?>
                        <div class="container hero">
                            <div class="row">
                                <div class="col-12 col-lg-6 col-xl-5 offset-xl-1">
                                    <h1><?php echo $currentUser["username"] ?></h1>
                                    <p>Tên đầy đủ: <?php echo ($currentUser["fullname"] != "" || $currentUser["fullname"]) != null ? $currentUser["fullname"] : "Chưa có"; ?></p>
                                    <p>Số điện thoại: <?php echo ($currentUser["mobilenumber"] != "" || $currentUser["mobilenumber"]) != null ? $currentUser["mobilenumber"] : "Chưa có"; ?></p>
                                    <p>Email: <?php echo ($currentUser["email"] != "" || $currentUser["email"]) != null ? $currentUser["email"] : "Chưa có"; ?></p>
                                    <button class="btn btn-light btn-lg action-button" type="button" id="postButton">Tạo bài viết</button></div>
                                <div class="col-md-5 col-lg-5 offset-lg-1 offset-xl-1 d-none d-lg-block">
                                    <div class="center-avatar">
                                        <?php if (isset($currentUser['pfp'])): ?>
                                            <img class="lazyload blur-up" data-src="profilepfp.php?id=<?php echo $currentUser['profileID']; ?>&width=720&height=720" src="profilepfp.php?id=<?php echo $currentUser['profileID']; ?>&placeholder">
                                        <?php else: ?>
                                            <img class="lazyload" data-src="assets\img\defaultavataruser.png">
                                        <?php endif?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="postModal" class="modal">
                            <div class="modal-content">
                                <span class="closeModal">&times;</span>
                                <form method="post" action="post.php" enctype="multipart/form-data">
                                    <div class="form-group input-group">
                                        <textarea name="content" class="form-control" placeholder="Trạng thái..." rows="5"></textarea>
                                    </div> <!-- form-group -->
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-globe"></i> </span>
                                        </div>
                                        <select name="privacy" class="form-control">
                                            <?php foreach ($privacy as $visibility) : ?>
                                                <option value="<?php echo $visibility["id"] ?>"><?php echo $visibility["visibility"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> <!-- form-group -->
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-upload"></i> </span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="postimg" class="custom-file-input" id="customFile" accept="image/*">
                                            <label class="custom-file-label" for="customFile">Hình ảnh</label>
                                        </div>
                                    </div>
                                                            
                                    <div class="form-group">
                                        <button name="post_the_status" type="submit" class="btn btn-primary btn-block">Đăng</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php $user = findUserByID($_GET['id']); ?>
                        <?php if ($user == null) : ?>
                            <div class="container hero">
                                <p class="text-center">Người dùng mà bạn đang tìm kiếm không tồn tại.</p>
                            </div>
                        <?php else : ?>
                            <div class="container hero">
                                <div class="row">
                                    <div class="col-12 col-lg-6 col-xl-5 offset-xl-1">
                                        <h1><?php echo $user["username"]; ?></h1>
                                        <p>Tên đầy đủ: <?php echo ($user["fullname"] != "" || $user["fullname"]) != null ? $user["fullname"] : "Chưa có"; ?></p>
                                        <p>Số điện thoại: <?php echo ($user["mobilenumber"] != "" || $user["mobilenumber"]) != null ? $user["mobilenumber"] : "Chưa có"; ?></p>
                                        <p>Email: <a href="mailto:<?php echo $user["email"];?>" style="color:white;" ><?php echo $user["email"];?></a></p>
                                        <input type="hidden" name="userID" value="<?php echo  $_GET['profileID'];?>">
                                        <?php 
                                              $isExist = getFriendRequestStatus($currentUser["profileID"], $user["profileID"],$currentUser["profileID"], $user["profileID"]);
                                         ?>
                                         <?php if($isExist["status"] == 0 && $isExist["userone"] == $currentUser["profileID"]) :?>
                                           <?php
                                                    echo "<form method='POST' action='remove-friend.php'>
                                                        <button class='btn btn-light btn-lg action-button' name='unFriend' value='". $user['profileID'] ."'type='submit'>Hủy Yêu Cầu Kết Bạn</button>
                                                    </form>"
                                             ?>

                                          <?php elseif($isExist["status"] == null ) :?>
                                           <?php
                                                     echo "<form method='POST' action='add-friend.php'>
                                                        <button class='btn btn-light btn-lg action-button' name='addFriend' value='". $user['profileID'] ."'type='submit'>Kết Bạn</button>
                                                    </form>"
                                             ?>                                      

                                         <?php elseif($isExist["status"] == 0 && $isExist["usertwo"] == $currentUser["profileID"]) :?>
                                           <?php
                                                    echo "<form method='POST' action='remove-friend.php'>
                                                        <button class='btn btn-light btn-lg action-button' name='acceptFriendRequest' value='". $user['profileID'] ."'type='submit'>Chấp Nhận Yêu Cầu Kết Bạn</button>
                                                        <button class='btn btn-light btn-lg action-button' name='unFriend' value='". $user['profileID'] ."'type='submit'>Từ Chối Yêu Cầu Kết Bạn</button>
                                                    </form>"
                                             ?>
                                             <?php
                                                else:
                                                    echo "<p><i class='fas fa-user-friends'> Bạn bè </i></p>";
                                                     echo "<form method='POST' action='remove-friend.php'>
                                                        <button class='btn btn-light btn-lg action-button' name='unFriend' value='". $user['profileID'] ."'type='submit'>Hủy Kết Bạn</button>
                                                    </form>"
                                             ?>
                                         <?php
                                            endif;
                                            $temp = startingChat($_SESSION['profileID'], $user['profileID']);
                                            echo "<form method='GET' action='messenger.php'>
                                            <input name ='conversationID' value ='". $temp['conversationID'] ."' style = 'display:none;'>
                                            <button class='btn btn-light btn-lg action-button' name='profileID' value='". $_SESSION['profileID'] ."'type='submit'>Nhắn tin</button>
                                            </form>";
                                         ?>
                                    </div>
                                    <div class="col-md-5 col-lg-5 offset-lg-1 offset-xl-1 d-none d-lg-block">
                                        <div class="center-avatar">
                                            <?php if (isset($user['pfp'])): ?>
                                                <img class="lazyload blur-up" data-src="profilepfp.php?id=<?php echo $user['profileID']; ?>&width=720&height=720" src="profilepfp.php?id=<?php echo $user['profileID']; ?>&placeholder">
                                            <?php else: ?>
                                                <img class="lazyload" data-src="assets\img\defaultavataruser.png">
                                            <?php endif?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                    <div id="newfeed" style="margin-top: 200px; font-family: 'Roboto', sans-serif;">
                        <div class="row" id="newfeed_content">
                        </div>
                    </div>
                    <!-- The Image Modal -->
                    <div id="imageModal" class="image-modal">
                        <span class="close-img-modal">&times;</span>
                        <img class="img-modal-content blur-up" id="imgModal">
                        <div id="modal-caption"></div>
                    </div>
                    <div id="load_more" class="col-sm-12 mt-5 text-center">
                        <div id="spinner"></div>
                        <button id="button_more" name="button_more" style="display: none" data-page="<?php echo $currentPage ?>" class="btn btn-primary">Xem thêm</button>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    <?php include '_footer.php'; ?>
    <script src="assets/js/content-p.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/privacychange.js"></script>
    <script src="assets/js/imagemodal.js"></script>
    <script>
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>

</html>