<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BloodTypes Model
 *
 * @property \App\Model\Table\DonorsTable&\Cake\ORM\Association\HasMany $Donors
 *
 * @method \App\Model\Entity\BloodType newEmptyEntity()
 * @method \App\Model\Entity\BloodType newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\BloodType> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BloodType get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\BloodType findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\BloodType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\BloodType> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BloodType|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\BloodType saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\BloodType>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BloodType>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BloodType>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BloodType> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BloodType>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BloodType>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BloodType>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BloodType> deleteManyOrFail(iterable $entities, array $options = [])
 */
class BloodTypesTable extends Table
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

        $this->setTable('blood_types');
        $this->setDisplayField('blood_group');
        $this->setPrimaryKey('id');

        $this->hasMany('Donors', [
            'foreignKey' => 'blood_type_id',
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
            ->scalar('blood_group')
            ->maxLength('blood_group', 5)
            ->requirePresence('blood_group', 'create')
            ->notEmptyString('blood_group')
            ->add('blood_group', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['blood_group']), ['errorField' => 'blood_group']);

        return $rules;
    }
}
