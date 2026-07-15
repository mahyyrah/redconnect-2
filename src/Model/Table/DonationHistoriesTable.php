<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DonationHistories Model
 *
 * @property \App\Model\Table\DonorsTable&\Cake\ORM\Association\BelongsTo $Donors
 * @property \App\Model\Table\StaffsTable&\Cake\ORM\Association\BelongsTo $Staffs
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\BelongsTo $Appointments
 * @property \App\Model\Table\CertificatesTable&\Cake\ORM\Association\HasOne $Certificates
 *
 * @method \App\Model\Entity\DonationHistory newEmptyEntity()
 * @method \App\Model\Entity\DonationHistory newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\DonationHistory> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DonationHistory get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\DonationHistory findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\DonationHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\DonationHistory> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DonationHistory|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\DonationHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\DonationHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\DonationHistory>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\DonationHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\DonationHistory> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\DonationHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\DonationHistory>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\DonationHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\DonationHistory> deleteManyOrFail(iterable $entities, array $options = [])
 */
class DonationHistoriesTable extends Table
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

        $this->setTable('donation_histories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Donors', [
            'foreignKey' => 'donor_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Staffs', [
            'foreignKey' => 'staff_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Appointments', [
            'foreignKey' => 'appointment_id',
        ]);
        $this->hasOne('Certificates', [
            'foreignKey' => 'donation_history_id',
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
            ->nonNegativeInteger('donor_id')
            ->notEmptyString('donor_id');

        $validator
            ->nonNegativeInteger('staff_id')
            ->notEmptyString('staff_id');

        $validator
            ->nonNegativeInteger('appointment_id')
            ->allowEmptyString('appointment_id');

        $validator
            ->date('donation_date')
            ->requirePresence('donation_date', 'create')
            ->notEmptyDate('donation_date');

        $validator
            ->integer('quantity_pack')
            ->requirePresence('quantity_pack', 'create')
            ->notEmptyString('quantity_pack');

        $validator
            ->scalar('remarks')
            ->maxLength('remarks', 255)
            ->allowEmptyString('remarks');

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
        $rules->add($rules->existsIn(['donor_id'], 'Donors'), ['errorField' => 'donor_id']);
        $rules->add($rules->existsIn(['staff_id'], 'Staffs'), ['errorField' => 'staff_id']);
        $rules->add($rules->existsIn(['appointment_id'], 'Appointments'), ['errorField' => 'appointment_id']);

        return $rules;
    }
}
