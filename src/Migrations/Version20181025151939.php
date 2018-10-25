<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181025151939 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE role_hierarchy DROP FOREIGN KEY FK_AB8EFB72644EF354');
        $this->addSql('ALTER TABLE role_hierarchy DROP FOREIGN KEY FK_AB8EFB72EC9C6612');
        $this->addSql('ALTER TABLE role_hierarchy ADD CONSTRAINT FK_AB8EFB72644EF354 FOREIGN KEY (child_uuid) REFERENCES role (uuid) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_hierarchy ADD CONSTRAINT FK_AB8EFB72EC9C6612 FOREIGN KEY (parent_uuid) REFERENCES role (uuid) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE role_hierarchy DROP FOREIGN KEY FK_AB8EFB72EC9C6612');
        $this->addSql('ALTER TABLE role_hierarchy DROP FOREIGN KEY FK_AB8EFB72644EF354');
        $this->addSql('ALTER TABLE role_hierarchy ADD CONSTRAINT FK_AB8EFB72EC9C6612 FOREIGN KEY (parent_uuid) REFERENCES role (uuid)');
        $this->addSql('ALTER TABLE role_hierarchy ADD CONSTRAINT FK_AB8EFB72644EF354 FOREIGN KEY (child_uuid) REFERENCES role (uuid)');
    }
}
