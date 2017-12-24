<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171224163657 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE songs (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, genre_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, released_at DATETIME NOT NULL, INDEX IDX_BAECB19BB7970CF8 (artist_id), INDEX IDX_BAECB19B4296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artists (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE songs ADD CONSTRAINT FK_BAECB19BB7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE songs ADD CONSTRAINT FK_BAECB19B4296D31F FOREIGN KEY (genre_id) REFERENCES genres (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE songs DROP FOREIGN KEY FK_BAECB19B4296D31F');
        $this->addSql('ALTER TABLE songs DROP FOREIGN KEY FK_BAECB19BB7970CF8');
        $this->addSql('DROP TABLE songs');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE artists');
    }
}
