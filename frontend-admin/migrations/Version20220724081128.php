<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220724081128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe_catalog ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe_catalog ADD CONSTRAINT FK_57C83C07727ACA70 FOREIGN KEY (parent_id) REFERENCES recipe_catalog (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_57C83C07727ACA70 ON recipe_catalog (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE recipe_catalog DROP CONSTRAINT FK_57C83C07727ACA70');
        $this->addSql('DROP INDEX IDX_57C83C07727ACA70');
        $this->addSql('ALTER TABLE recipe_catalog DROP parent_id');
    }
}
