<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181025151515 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(190) NOT NULL, password VARCHAR(60) NOT NULL, PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_roles (user_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', role_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_54FCD59FABFE1C6F (user_uuid), INDEX IDX_54FCD59F6FC02232 (role_uuid), PRIMARY KEY(user_uuid, role_uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_hierarchy (parent_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', child_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_AB8EFB72EC9C6612 (parent_uuid), INDEX IDX_AB8EFB72644EF354 (child_uuid), PRIMARY KEY(parent_uuid, child_uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FABFE1C6F FOREIGN KEY (user_uuid) REFERENCES user (uuid) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59F6FC02232 FOREIGN KEY (role_uuid) REFERENCES role (uuid) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_hierarchy ADD CONSTRAINT FK_AB8EFB72EC9C6612 FOREIGN KEY (parent_uuid) REFERENCES role (uuid)');
        $this->addSql('ALTER TABLE role_hierarchy ADD CONSTRAINT FK_AB8EFB72644EF354 FOREIGN KEY (child_uuid) REFERENCES role (uuid)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59FABFE1C6F');
        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59F6FC02232');
        $this->addSql('ALTER TABLE role_hierarchy DROP FOREIGN KEY FK_AB8EFB72EC9C6612');
        $this->addSql('ALTER TABLE role_hierarchy DROP FOREIGN KEY FK_AB8EFB72644EF354');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_roles');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_hierarchy');
    }
}
