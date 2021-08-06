<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210728155515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coach (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discipline_coach (discipline_id INT NOT NULL, coach_id INT NOT NULL, INDEX IDX_783EDE84A5522701 (discipline_id), INDEX IDX_783EDE843C105691 (coach_id), PRIMARY KEY(discipline_id, coach_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE discipline_coach ADD CONSTRAINT FK_783EDE84A5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discipline_coach ADD CONSTRAINT FK_783EDE843C105691 FOREIGN KEY (coach_id) REFERENCES coach (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE discipline_coach DROP FOREIGN KEY FK_783EDE843C105691');
        $this->addSql('DROP TABLE coach');
        $this->addSql('DROP TABLE discipline_coach');
    }
}
