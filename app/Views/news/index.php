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