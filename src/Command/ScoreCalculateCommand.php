<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\ScoreService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'score:calculate',
    description: 'Add a short description for your command',
)]
class ScoreCalculateCommand extends Command
{

    public function __construct(
        private EntityManagerInterface $manager,
        private UserRepository $userRepo,
        private ScoreService $scoreService
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('userId', InputArgument::OPTIONAL, 'User ID')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId = $input->getArgument('userId');

        if ($userId) {
            if ($user = $this->userRepo->find($userId)) {

                $this->printScore($output, $user, $this->updateUserScore($user));

                $this->manager->flush();
            } else {
                $output->writeln("User with id \"$userId\" not found");
            }

            return Command::SUCCESS;
        }

        foreach ($this->userRepo->findAll() as $user) {
            $this->printScore($output, $user, $this->updateUserScore($user));
        }

        $this->manager->flush();

        return Command::SUCCESS;
    }

    /**
     * @param User $user
     *
     * @return [] scoreDetails
     */
    private function updateUserScore(User $user): array
    {
        $scoreDetails = $this->scoreService->getDetail($user);

        $user->setScore(array_sum($scoreDetails));

        return $scoreDetails;
    }

    /**
     * @param OutputInterface $output
     * @param User $user
     * @param [] $score
     *
     * @return int totalScore
     */
    private function printScore(OutputInterface $output, User $user, array $score): void
    {
        $score = array_merge($score, ['Total Score' => $user->getScore()]);

        $output->writeln(
            sprintf(
                '%s %s(#%d):',
                $user->getName(),
                $user->getSurname(),
                $user->getId()
            )
        );

        foreach ($score as $key => $value) {
            $output->writeln(sprintf('%s - %d', $key, $value));
        }

        $output->writeln('');
    }
}
