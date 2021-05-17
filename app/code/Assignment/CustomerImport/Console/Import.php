<?php
namespace Assignment\CustomerImport\Console;

use Exception;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Console\Cli;
use Magento\Framework\Filesystem;
use Magento\Framework\App\State;
use Magento\Framework\App\Area;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Assignment\CustomerImport\Model\Customer;
use Psr\Log\LoggerInterface;
use Magento\Framework\View\Asset\Repository;

class Import extends Command
{
  const FILENAME = 'filename';
  private $filesystem;
  private $customer;
  private $state;

   /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Repository
     */
    private $assetRepository;
   
  public function __construct(
      Filesystem $filesystem,
      Customer $customer,
      State $state,
      LoggerInterface $logger,
      Repository $assetRepository
  ) {
  parent::__construct();
      $this->filesystem = $filesystem;
      $this->customer = $customer;
      $this->state = $state;
      $this->logger = $logger;
      $this->assetRepository = $assetRepository;
  }

  public  function configure()
  {
    $options = [
      new InputOption(
        self::FILENAME,
        null,
        InputOption::VALUE_REQUIRED,
        'filename'
      )
    ];
    $this->setName('customer:import')
      ->setDescription('Demo command line')
      ->setDefinition($options);;
    //$this->setDescription('Demo command line');
   
    parent::configure();
  } 

  public function execute(InputInterface $input, OutputInterface $output): ?int
  {
    if ($name = $input->getOption(self::FILENAME)) {
      

      $fileExtension = substr($name, strpos($name, ".") + 1);    
     //echo $fileExtension;exit;

      
      try {
          $this->state->setAreaCode(Area::AREA_GLOBAL);
     
          /*$mediaDir = $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA);
          $fixture = $mediaDir->getAbsolutePath() . 'fixtures/'. $name;*/
          $fileId = 'Assignment_CustomerImport::customers/'.$name;
         //echo $fixture;exit;

          //$fileId = 'Assignment_CustomerImport::images/holiday1.png';
 
        $params = [
            'area' => 'frontend' //for admin area its backend
        ];
 
        $asset = $this->assetRepository->createAsset($fileId, $params);
 
        $fixture = null;
        try {
            $fixture = $asset->getSourceFile();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
        }

          $this->customer->install($fixture, $output, $fileExtension);
     
          return Cli::RETURN_SUCCESS;
      } catch (Exception $e) {
          $msg = $e->getMessage();
          $output->writeln("<error>$msg</error>", OutputInterface::OUTPUT_NORMAL);
          return Cli::RETURN_FAILURE;
      }
    }else {

      $output->writeln("Hello World");

    }
    return $this;
  }
}