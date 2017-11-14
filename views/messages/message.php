<!--<div class="message-body">-->
<!--    <div class="message-left">-->
<!--        <ul>-->
<!--            --><?php //foreach ($users as $user): ?>
<!---->
<!---->
<!--            --><?php //endforeach; ?>
<!--        </ul>-->
<!--    </div>-->
<!---->
<!--    <div class="message - right">-->
<!--        <!-- display message -->-->
<!--        <div class="display - message">-->
<!--            --><?php
//            //check $_GET&#91;'id'&#93; is set
//            if (isset($_GET &#91;'id'&#93;)){
//                $user_two = trim(mysqli_real_escape_string($con, $_GET &#91;'id'&#93;));
//                    //check $user_two is valid
//                    $q = mysqli_query($con, "SELECT `id` FROM `user` WHERE id = '$user_two' AND id != '$user_id'");
//            //valid $user_two
//            if (mysqli_num_rows($q) == 1) {
//                //check $user_id and $user_two has conversation or not if no start one
//                $conver = mysqli_query($con, "SELECT * FROM `conversation` WHERE(user_one = '$user_id' AND user_two = '$user_two') OR (user_one = '$user_two' AND user_two = '$user_id')");
//
//                //they have a conversation
//                if (mysqli_num_rows($conver) == 1) {
//                    //fetch the converstaion id
//                    $fetch = mysqli_fetch_assoc($conver);
//                    $conversation_id = $fetch &#91;'id'&#93;;
//                        } else { //they do not have a conversation
//                    //start a new converstaion and fetch its id
//                    $q = mysqli_query($con, "INSERT INTO `conversation` VALUES('', '$user_id', $user_two)");
//                    $conversation_id = mysqli_insert_id($con);
//                }
//            } else {
//                die("Invalid $_GET ID . ");
//            }
//            }else {
//                die("Click On the Person to start Chating . ");
//            }
//            ?>
<!--        </div>-->
<!--        <!-- /display message -->-->
<!---->
<!--        <!-- send message -->-->
<!--        <div class="send - message">-->
<!--            <!-- store conversation_id, user_from, user_to so that we can send send this values to post_message_ajax.php -->-->
<!--            <input type="hidden" id="conversation_id" value=" --><?php //echo base64_encode($conversation_id); ?><!--">-->
<!--            <input type="hidden" id="user_form" value="--><?php //echo base64_encode($user_id); ?><!--">-->
<!--            <input type="hidden" id="user_to" value="--><?php //echo base64_encode($user_two); ?><!--">-->
<!--            <div class="form-group">-->
<!--                <textarea class="form-control" id="message" placeholder="Enter Your Message"></textarea>-->
<!--            </div>-->
<!--            <button class="btn btn-primary" id="reply">Reply</button>-->
<!--            <span id="error"></span>-->
<!--        </div>-->
<!--        <!-- / send message -->-->
<!--    </div>-->
<!--</div>-->