
<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>
<!-- Modal -->
<div class="modal fade" id="add_post_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" enctype="multipart/form-data" id="add_post_form">
                    <?= csrf_field() ?>

                    <label for="title">Title</label>
                    <input type="input" name="title" value="<?= set_value('title') ?>">
                    <br>

                    <label for="body">Text</label>
                    <textarea name="body" cols="45" rows="4"><?= set_value('body') ?></textarea>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="add_post_btn" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row my-4">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="text-secondary fw-bold fs-3">All Posts</div>
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#add_post_modal">Add New Post</button>
                </div>
                <div class="card-body">
                    <div class="row" id="show_posts">
                        <?php if (!empty($news) && is_array($news)) : ?>

                            <div id="news">

                                <?php foreach ($news as $news_item) : ?>

                                    <div class="news-item">

                                        <h3><?= esc($news_item['title']) ?></h3>

                                        <div class="main">
                                            <p><?= esc($news_item['body']) ?></p>
                                        </div>
                                        <button><a href="/news/<?= esc($news_item['slug'], 'url') ?>">View</a></button>
                                        <button><a href="/news/update/<?= esc($news_item['id']) ?>">Update</a></button>
                                        <button><a href="/news/delete/<?= esc($news_item['id']) ?>">Delete</a></button>

                                    </div>


                                <?php endforeach ?>
                            </div>


                        <?php else : ?>

                            <h3>No News</h3>

                            <p>Unable to find any news for you.</p>

                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>