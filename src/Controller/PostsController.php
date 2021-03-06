<?php
declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\UploadedFileInterface;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $posts = $this->Posts
            ->find()
            ->contain(['Categories'])
            ->all();

        $this->set('posts', $posts);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Categories'],
        ]);

        $this->set(compact('post'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEmptyEntity();

        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());

            // Récupération de l'image
            /** @var \Laminas\Diactoros\UploadedFile $image */
            $image = $this->request->getData('image_file');

            if($image->getError() === UPLOAD_ERR_OK) { 

                $imageName = $image->getClientFileName();

                // Dossier de destination
                $targetFolder = WWW_ROOT . 'img' . DS . $imageName;

                $image->moveTo($targetFolder);

                $post->image = $imageName;
                
                $post->setDirty('image_file');
            }

            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $categories = $this->Posts->Categories->find('list', ['limit' => 200])->all();
        
        $this->set(compact('post', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());

            // Récupération de l'image
            /** @var \Laminas\Diactoros\UploadedFile $image */
            $image = $this->request->getData('change_file');

            if($image->getError() === UPLOAD_ERR_OK) { 

                $imageName = $image->getClientFileName();

                // Dossier de destination
                $targetFolder = WWW_ROOT . 'img' . DS . $imageName;

                $image->moveTo($targetFolder);

                $post->image = $imageName;
                
                $post->setDirty('change_file');
            }

            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $categories = $this->Posts->Categories->find('list', ['limit' => 200])->all();
        $this->set(compact('post', 'categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
