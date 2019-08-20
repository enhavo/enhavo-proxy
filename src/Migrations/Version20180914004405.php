<?php

namespace DoctrineMigrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180914004405 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_route (id INT AUTO_INCREMENT NOT NULL, variablePattern VARCHAR(255) DEFAULT NULL, staticPrefix VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, position INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, typeId INT DEFAULT NULL, INDEX name_idx (name), INDEX prefix_idx (staticPrefix), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_session (id VARCHAR(255) NOT NULL, value LONGTEXT NOT NULL, time INT NOT NULL, lifetime INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8F02BF9D5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, firstName VARCHAR(255) DEFAULT NULL, lastName VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_F7129A8092FC23A8 (username_canonical), UNIQUE INDEX UNIQ_F7129A80A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_28657971A76ED395 (user_id), INDEX IDX_28657971FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_file (id INT AUTO_INCREMENT NOT NULL, mimeType VARCHAR(255) DEFAULT NULL, extension VARCHAR(255) DEFAULT NULL, `order` INT DEFAULT NULL, filename VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, parameters LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', garbage TINYINT(1) NOT NULL, garbageTimestamp DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_backend (id INT AUTO_INCREMENT NOT NULL, host_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, hostname VARCHAR(255) DEFAULT NULL, port INT DEFAULT NULL, connectTimeout INT DEFAULT NULL, firstByteTimeout INT DEFAULT NULL, betweenBytesTimeout INT DEFAULT NULL, INDEX IDX_19FBC5141FB8D185 (host_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_host (id INT AUTO_INCREMENT NOT NULL, domain VARCHAR(255) DEFAULT NULL, https INT DEFAULT NULL, transferType VARCHAR(255) DEFAULT NULL, backendStrategy VARCHAR(255) DEFAULT NULL, directorName VARCHAR(255) DEFAULT NULL, certificate LONGTEXT DEFAULT NULL, certificateKey LONGTEXT DEFAULT NULL, certificateRequest LONGTEXT DEFAULT NULL, certificateType VARCHAR(255) DEFAULT NULL, redirect VARCHAR(255) DEFAULT NULL, `default` TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_user_group ADD CONSTRAINT FK_28657971A76ED395 FOREIGN KEY (user_id) REFERENCES user_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user_group ADD CONSTRAINT FK_28657971FE54D947 FOREIGN KEY (group_id) REFERENCES user_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_backend ADD CONSTRAINT FK_19FBC5141FB8D185 FOREIGN KEY (host_id) REFERENCES project_host (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_user_group DROP FOREIGN KEY FK_28657971FE54D947');
        $this->addSql('ALTER TABLE user_user_group DROP FOREIGN KEY FK_28657971A76ED395');
        $this->addSql('ALTER TABLE project_backend DROP FOREIGN KEY FK_19FBC5141FB8D185');
        $this->addSql('DROP TABLE app_route');
        $this->addSql('DROP TABLE app_session');
        $this->addSql('DROP TABLE user_group');
        $this->addSql('DROP TABLE user_user');
        $this->addSql('DROP TABLE user_user_group');
        $this->addSql('DROP TABLE media_file');
        $this->addSql('DROP TABLE project_backend');
        $this->addSql('DROP TABLE project_host');
        $this->addSql('DROP TABLE User');
    }
}
