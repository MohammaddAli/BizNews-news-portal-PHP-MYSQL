<?php
session_start();
$userId = $_SESSION['id'];

include "./lib/comment.php";
include "./lib/validation.php";
include "./lib/comment_reply.php";

$commentObject = new comment;
$commentReplyObject = new commentReply;
$errors = [];

// Check if it's a POST request for adding a new comment
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment']) && isset($_POST['singleNewsId'])) {
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';
    $singleNewsId = isset($_POST['singleNewsId']) ? $_POST['singleNewsId'] : '';

    if (empty($comment) || empty($singleNewsId)) {
        // Return a JSON response with error message
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Please provide comment and singleNewsId']);
    } else {
        $mysqliInsertId = $commentObject->addNewComment($comment, $singleNewsId, $userId);

        if ($mysqliInsertId) {
            $oneComment = $commentObject->getComment($mysqliInsertId);
            echo json_encode($oneComment);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid request']);
        }
    }
}

// Check if it's a POST request for adding a comment reply
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['commentId']) && isset($_POST['replyMessage'])) {
    $commentId = $_POST['commentId'];
    $replyMessage = $_POST['replyMessage'];

    // Process the comment reply
    $mysqliInsertId = $commentReplyObject->addNewCommentReply($replyMessage, $commentId);

    if ($mysqliInsertId) {
        $oneComment = $commentReplyObject->getCommentReply($mysqliInsertId);
        header('Content-Type: application/json');
        echo json_encode($oneComment);
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Failed to insert comment reply']);
    }
}
