<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191003102322 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_rule ADD host_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_rule ADD CONSTRAINT FK_43F6896C1FB8D185 FOREIGN KEY (host_id) REFERENCES project_host (id)');
        $this->addSql('CREATE INDEX IDX_43F6896C1FB8D185 ON app_rule (host_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_rule DROP FOREIGN KEY FK_43F6896C1FB8D185');
        $this->addSql('DROP INDEX IDX_43F6896C1FB8D185 ON app_rule');
        $this->addSql('ALTER TABLE app_rule DROP host_id');
    }
}
