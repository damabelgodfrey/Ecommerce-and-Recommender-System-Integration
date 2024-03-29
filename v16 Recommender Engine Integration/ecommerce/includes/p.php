<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerce/recommender/controller/algorithms/EuclideanDistance.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerce/recommender/controller/algorithms/RatingBasedCosineSimilarity.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerce/recommender/controller/algorithms/CF_AdjustedCosineSimilarity.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerce/recommender/controller/algorithms/PearsonCorrelation.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerce/recommender/controller/PredictionController.php';
/**
 *
 */
class UserBasedCollaborativeFilteringA1
{

  private static $similarity;
  private static $sim_Rating_product = array();
  private static $simSummation = array();
  private static $userMeanRating;
  public static function getPredict($simAlgorithm,$allUserMatrix, $currentUser){
  self:: $sim_Rating_product = array();
  self::$simSummation =array();
  $userSimilarityArr = array();
  if(isset($allUserMatrix[$currentUser])){
    foreach($allUserMatrix as $otherUser =>$value){
      if($otherUser !=$currentUser){
        switch ($simAlgorithm) {
          case 'CosineSimilarity':
            self::$similarity = RatingBasedCosineSimilarity::computeF_CosineSimilarity($allUserMatrix,$currentUser,$otherUser);
            break;

          case 'EuclideanDistance':
            self::$similarity = EuclideanDistance::computeEuclideanDistance($allUserMatrix,$currentUser,$otherUser);
            break;

          case 'PearsonCorrelation':
            self::$similarity = PearsonCorrelation::my_pearson_correlation2($allUserMatrix,$currentUser,$otherUser);
            break;

          case 'AdjustedCosineSim':
            self::$similarity = CF_AdjustedCosineSimilarity::conputeF_adjustedCosineSimilarity($allUserMatrix,$currentUser,$otherUser);
            break;

          default:
            break;
        }
      self::prediction($allUserMatrix,$currentUser,$otherUser);
      debugfilewriter("\nUser Similarity Coefficient A1".' '.$otherUser.' '.self::$similarity);
      if(self::$similarity != 0){ // store only similar user
        $userSimilarityArr[$otherUser] = self::$similarity;
       }
      }
    }
  }
    $A1 = self::computeRatingPrediction();
    $SC = new PredictionController();
    arsort($userSimilarityArr);
    $SC->insertCFComputation("UserBasedNearestNeigbour", $currentUser, $userSimilarityArr); //insert nearest neighbour to database
    return $A1;
  }
   // compute the summation of the product of other user rating and similarity between this user and other user
   //compute the summaration of the similarity
   //Sim*RU1 and sum of simmilarity
  public static function prediction($ExistingMatrix,$currentUser,$otherUser){
  $sim = self::$similarity;
  if(isset($ExistingMatrix[$currentUser])){
    foreach($ExistingMatrix[$otherUser] as $key=>$value){
      if(!array_key_exists($key,$ExistingMatrix[$currentUser])){
        if(!array_key_exists($key,self::$sim_Rating_product)){
          self::$sim_Rating_product[$key] = 0;
        }

        self::$sim_Rating_product[$key]+=$ExistingMatrix[$otherUser][$key]*$sim;
        if(!array_key_exists($key,self::$simSummation)){
          self::$simSummation[$key] = 0;
        }
        self::$simSummation[$key]+=$sim;
      }
    }
   }
  }
//compute summation of Sim*RU1/sum of simmilarity
  public static function computeRatingPrediction(){
    $itemRatingPredictionArray = array();
    $sim_Rating_product =self::$sim_Rating_product;
    $simSummation= self::$simSummation;
    foreach ($sim_Rating_product as $key => $value) {
      if($simSummation[$key] != 0){
        $itemRatingPredictionArray[$key]= to2Decimal($value/$simSummation[$key]);
      }

    }
    arsort($itemRatingPredictionArray);
    RootMeanSquareEstimation::computeRootMeanSqEst($itemRatingPredictionArray);
  return $itemRatingPredictionArray;
  }
}
