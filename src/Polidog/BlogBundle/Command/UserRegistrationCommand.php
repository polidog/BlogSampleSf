<?php


namespace Polidog\BlogBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class UserRegistrationCommand extends ContainerAwareCommand
{

    private static $questions = [
        'email' => 'Please enter the email: ',
        'name' => 'Please enter the your name: ',
        'password' => 'Please enter the password: '
    ];

    protected function configure()
    {
        $this->setName('polidog_blog:user_registration');
        $this->setDescription('管理者ユーザーを作成する')
            ->setDefinition([
                new InputArgument('email', InputArgument::REQUIRED, 'ログインメールアドレス'),
                new InputArgument('name', InputArgument::REQUIRED, '名前'),
                new InputArgument("password", InputArgument::REQUIRED, "パスワード")
            ])
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $email = $input->getArgument('email');
        $name = $input->getArgument("name");
        $password = $input->getArgument("password");

        $registerUser = $this->getContainer()->get('polidog_blog.use_case.register_user');
        $registerUser->run($name,$email, $password);
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper("question");
        foreach (self::$questions as $target => $question) {
            if (!$input->getArgument($target)) {
                $question = new Question($question, null);
                $answer = $helper->ask($input, $output, $question);
                $input->setArgument($target, $answer);
            }
        }
    }


}
