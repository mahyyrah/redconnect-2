<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Donors Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BloodTypesTable&\Cake\ORM\Association\BelongsTo $BloodTypes
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\HasMany $Appointments
 * @property \App\Model\Table\DonationHistoriesTable&\Cake\ORM\Association\HasMany $DonationHistories
 *
 * @method \App\Model\Entity\Donor newEmptyEntity()
 * @method \App\Model\Entity\Donor newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Donor> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Donor get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Donor findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Donor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Donor> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Donor|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Donor saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Donor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Donor>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Donor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Donor> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Donor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Donor>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Donor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Donor> deleteManyOrFail(iterable $entities, array $options = [])
 */
class DonorsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('donors');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('BloodTypes', [
            'foreignKey' => 'blood_type_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Appointments', [
            'foreignKey' => 'donor_id',
        ]);
        $this->hasMany('DonationHistories', [
            'foreignKey' => 'donor_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id')
            ->add('user_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->nonNegativeInteger('blood_type_id')
            ->notEmptyString('blood_type_id');

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 100)
            ->requirePresence('full_name', 'create')
            ->notEmptyString('full_name');

        $validator
            ->scalar('ic_number')
            ->maxLength('ic_number', 12)
            ->requirePresence('ic_number', 'create')
            ->notEmptyString('ic_number')
            ->add('ic_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 20)
            ->requirePresence('phone_number', 'create')
            ->notEmptyString('phone_number');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 10)
            ->requirePresence('gender', 'create')
            ->notEmptyString('gender');

        $validator
            ->date('date_of_birth')
            ->requirePresence('date_of_birth', 'create')
            ->notEmptyDate('date_of_birth');

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->date('last_donation')
            ->allowEmptyDate('last_donation');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['user_id']), ['errorField' => 'user_id']);
        $rules->add($rules->isUnique(['ic_number']), ['errorField' => 'ic_number']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['blood_type_id'], 'BloodTypes'), ['errorField' => 'blood_type_id']);

        return $rules;
    }
}
