<?php declare(strict_types=1);

namespace Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181104000430 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
         $providers = $schema->createTable('providers');

         $providers->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
         $providers->addColumn('contact', 'json');
         $providers->addColumn('service', 'json');
         
         $providers->setPrimaryKey(['id']);
         
         $schema->createSequence('providers_seq');
    }

    public function down(Schema $schema) : void
    {
    	$schema->dropTable('providers');
    }
}
