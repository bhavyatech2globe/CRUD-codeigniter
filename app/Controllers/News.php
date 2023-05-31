<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    public function index()
    {
        $model = model(NewsModel::class);
        $data = [
            'news' => $model->getNews(),
            'title' => 'News archive',
        ];


        return view('templates/header', $data)
            . view('news/index')
            . view('templates/footer');
    }

    public function view($slug = false)
    {
        $model = model(NewsModel::class);
        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];


        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }


    public function create()
    {
        helper('form');


        // Checks whether the form is submitted.
        if (!$this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/header', ['title' => 'Create a news item'])
                . view('news/create')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['title', 'body']);


        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return view('templates/header', ['title' => 'Create a news item'])
                . view('news/create')
                . view('templates/footer');
        }

        $model = model(NewsModel::class);

        $model->save([
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
        ]);

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/success')
            . view('templates/footer');
    }

    public function delete($id = null)
    {
        $model = model(NewsModel::class);
        $data['news'] =  $model->delete($id);
        $data['title'] =  'item successfully deleted';
        return view('templates/header', $data)
            . view('news/delete')
            . view('templates/footer');
    }

    public function update($id = null)
    {
        helper('form');
        $model = model(NewsModel::class);
        $data = [
            'title' => 'Update the news item',
            'news' => $model->where(['id'=>$id])->first()
        ];
        // var_dump($data); die;
        if (!$this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/header', $data)
            . view('news/update')
            . view('templates/footer');
        }
        $post = $this->request->getPost(['id', 'title', 'body']);
        // Checks whether the submitted data passed the validation rules.

        if (!$this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return view('templates/header', $data)
                . view('news/update')
                . view('templates/footer');
        }

        $model->update($post['id'], [
            'title' => $post['title'],
            'body' => $post['body'],
        ]);


        return view('templates/header', $data)
            . view('news/success')
            . view('templates/footer');
    }
}
