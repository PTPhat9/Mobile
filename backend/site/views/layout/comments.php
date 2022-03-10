<?php foreach (array_slice($comments, 0, 5) as $comment): ?>
<div class="comment-item">
                        <div class="box-info">
                            <div class="avatar">
                                <?=strtoupper(substr($comment->getFullName(), 0, 1))?>
                            </div>
                            <div class="user">
                                <p class="name"><?=$comment->getFullName()?></p>
                            </div>
                        </div>
                        <div class="box-question">
                            <div class="rating">
                                <strong>Đánh giá: </strong>
                                <input type="text" class="answered-star-rating" value="<?=$comment->getStar()?>">
                            </div>
                            <div class="question">
                                <p>
                                    <strong>Nhận xét: </strong>
                                    <?=$comment->getDescription()?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
