<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Certificates Model
 *
 * @property \App\Model\Table\DonationHistoriesTable&\Cake\ORM\Association\BelongsTo $DonationHistories
 *
 * @method \App\Model\Entity\Certificate newEmptyEntity()
 * @method \App\Model\Entity\Certificate newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Certificate> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Certificate get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Certificate findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Certificate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Certificate> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Certificate|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Certificate saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Certificate>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Certificate>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Certificate>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Certificate> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Certificate>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Certificate>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Certificate>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Certificate> deleteManyOrFail(iterable $entities, array $options = [])
 */
class CertificatesTable extends Table
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

        $this->setTable('certificates');
        $this->setDisplayField('certificate_code');
        $this->setPrimaryKey('id');

        $this->belongsTo('DonationHistories', [
            'foreignKey' => 'donation_history_id',
            'joinType' => 'INNER',
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
            ->nonNegativeInteger('donation_history_id')
            ->notEmptyString('donation_history_id')
            ->add('donation_history_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('certificate_code')
            ->maxLength('certificate_code', 50)
            ->requirePresence('certificate_code', 'create')
            ->notEmptyString('certificate_code')
            ->add('certificate_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->dateTime('issued_at')
            ->notEmptyDateTime('issued_at');

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
        $rules->add($rules->isUnique(['donation_history_id']), ['errorField' => 'donation_history_id']);
        $rules->add($rules->isUnique(['certificate_code']), ['errorField' => 'certificate_code']);
        $rules->add($rules->existsIn(['donation_history_id'], 'DonationHistories'), ['errorField' => 'donation_history_id']);

        return $rules;
    }
}
