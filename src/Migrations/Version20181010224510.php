<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181010224510 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE material1 (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, id_categ INT NOT NULL, id_loaning INT NOT NULL, is_delete TINYINT(1) DEFAULT NULL, motif_delete VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE loaning ADD material_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE loaning ADD CONSTRAINT FK_38DDD8D0E308AC6F FOREIGN KEY (material_id) REFERENCES material1 (id)');
        $this->addSql('CREATE INDEX IDX_38DDD8D0E308AC6F ON loaning (material_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE loaning DROP FOREIGN KEY FK_38DDD8D0E308AC6F');
        $this->addSql('DROP TABLE material1');
        $this->addSql('DROP INDEX IDX_38DDD8D0E308AC6F ON loaning');
        $this->addSql('ALTER TABLE loaning DROP material_id');
    }
}
