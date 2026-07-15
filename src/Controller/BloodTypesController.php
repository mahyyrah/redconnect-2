<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BloodTypes Controller
 *
 * @property \App\Model\Table\BloodTypesTable $BloodTypes
 */
class BloodTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->BloodTypes->find();
        $bloodTypes = $this->paginate($query);

        $this->set(compact('bloodTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Blood Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bloodType = $this->BloodTypes->get($id, contain: ['Donors']);
        $this->set(compact('bloodType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bloodType = $this->BloodTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $bloodType = $this->BloodTypes->patchEntity($bloodType, $this->request->getData());
            if ($this->BloodTypes->save($bloodType)) {
                $this->Flash->success(__('The blood type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blood type could not be saved. Please, try again.'));
        }
        $this->set(compact('bloodType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Blood Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bloodType = $this->BloodTypes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bloodType = $this->BloodTypes->patchEntity($bloodType, $this->request->getData());
            if ($this->BloodTypes->save($bloodType)) {
                $this->Flash->success(__('The blood type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blood type could not be saved. Please, try again.'));
        }
        $this->set(compact('bloodType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Blood Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bloodType = $this->BloodTypes->get($id);
        if ($this->BloodTypes->delete($bloodType)) {
            $this->Flash->success(__('The blood type has been deleted.'));
        } else {
            $this->Flash->error(__('The blood type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
