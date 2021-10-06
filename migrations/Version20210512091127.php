<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512091127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz_history DROP FOREIGN KEY FK_4D50AF9FA76ED395');
        $this->addSql('ALTER TABLE quizz_history DROP FOREIGN KEY FK_4D50AF9FBCF5E72D');
        $this->addSql('DROP INDEX IDX_4D50AF9FA76ED395 ON quizz_history');
        $this->addSql('DROP INDEX IDX_4D50AF9FBCF5E72D ON quizz_history');
        $this->addSql('ALTER TABLE quizz_history ADD id_categorie INT NOT NULL, DROP user_id, CHANGE categorie_id id_user INT NOT NULL');
        $this->addSql('ALTER TABLE quizz_history ADD CONSTRAINT FK_4D50AF9F6B3CA4B FOREIGN KEY (id_user) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE quizz_history ADD CONSTRAINT FK_4D50AF9FC9486A13 FOREIGN KEY (id_categorie) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_4D50AF9F6B3CA4B ON quizz_history (id_user)');
        $this->addSql('CREATE INDEX IDX_4D50AF9FC9486A13 ON quizz_history (id_categorie)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz_history DROP FOREIGN KEY FK_4D50AF9F6B3CA4B');
        $this->addSql('ALTER TABLE quizz_history DROP FOREIGN KEY FK_4D50AF9FC9486A13');
        $this->addSql('DROP INDEX IDX_4D50AF9F6B3CA4B ON quizz_history');
        $this->addSql('DROP INDEX IDX_4D50AF9FC9486A13 ON quizz_history');
        $this->addSql('ALTER TABLE quizz_history ADD user_id INT DEFAULT NULL, ADD categorie_id INT NOT NULL, DROP id_user, DROP id_categorie');
        $this->addSql('ALTER TABLE quizz_history ADD CONSTRAINT FK_4D50AF9FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE quizz_history ADD CONSTRAINT FK_4D50AF9FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4D50AF9FA76ED395 ON quizz_history (user_id)');
        $this->addSql('CREATE INDEX IDX_4D50AF9FBCF5E72D ON quizz_history (categorie_id)');
    }
}
