<?= $this->extend("templates/baseSmallFooter") ?>
<?= $this->section("content") ?>
<div class="row d-flex messages-container">
    <!-- div for chat overview -->
    <div class="col-2 p-0 messages-chats">
        <?php if(isset($name) && isset($vendorId)): ?>
            <div class="chat-border d-flex align-items-center justify-content-start border p-3 clickable active-conversation">
                <?= $name[0]->Fname." ".$name[0]->Lname ?> 
                <a href="<?= "/messages/".$vendorId ?>" class="p-3 align-items-center" aria-label="click to open this chat">
                    <span class="link"></span>
                </a>
            </div> 
        <?php endif ?>
        <?php if(!$conversationIds == null) :?>
            <?php foreach($conversationIds as $chat): ?>
                <?php if (isset($vendorId) && $vendorId == $chat->UserId): ?>
                    <div class="d-flex align-items-center justify-content-start border p-3 clickable chat-border active-conversation">
                <?php else: ?>
                    <div class="d-flex align-items-center justify-content-start border p-3 clickable chat-border">
                <?php endif; ?>
                <?= $chat->Fname." ".$chat->Lname ?> 
                <a href="<?="/messages/".$chat->UserId ?>" class="p-3 align-items-center" aria-label="click to open this chat">
                    <span class="link"></span>
                </a>
            </div>
            <?php endforeach ?>
        <?php endif ?>
        <?php if ($conversationIds == null && !isset($name) && !isset($vendorId)): ?>
            <div class="alert alert-info" role="alert">
                You don't have any conversations yet. Go to 'Products>Product>Seller>Message me' to start a conversation
            </div>
        <?php endif; ?>
    </div>
    <!-- div for messages -->
    <div class="col p-0 flex-grow-1">
        <!-- div for chat enter field -->
        <div class="d-flex flex-column-reverse chat-field">
            <?php if (isset($messages)): ?>
                <?php foreach($messages as $message): ?>
                    <?php if($message->SendByUserId == $_SESSION['UserId']): ?>
                        <div class="m-2">
                            <div class="border p-2 chatmessage sender">
                                <p class="m-0"><?= $message->Message ?></p>
                                <a class="time-sender"><?= $message->SendTime ?></a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="m-2">
                            <div class="border p-2 receiver chatmessage">
                                <p class="m-0"><?= $message->Message ?></p>
                                <a class="time-receiver"><?= $message->SendTime ?></a>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            <?php endif ?>
        </div>
        <div class="row d-flex m-0">
            <?php if (isset($vendorId)): ?>
            <form method="post" action="<?= base_url("sendMessage/$vendorId") ?>" class="p-0">
                <div class="input-group p-0">
                    <label for="message" class="form-label" aria-label="the message you want to send"></label>
                    <input type="text" name="message" class="form-control message-bar">
                    <button class="btn btn-outline-secondary background-color-green" type="submit" id="button-addon2" aria-label="send the message">
                        <svg class="color-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                        </svg>
                    </button>
                </div>
            </form>
            <?php endif ?>
        </div>
    </div>
</div>
<?= $this->endsection() ?>