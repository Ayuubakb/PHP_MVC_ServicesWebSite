<?php
class Signals extends Model
{
    public function __construct(){
        self::getModel();
    }

    public function ignoreReclamation($reclamationId)
    {
        $query = self::$instance->prepare("DELETE FROM reclamations WHERE id = :reclamationId");
        $query->bindParam(':reclamationId', $reclamationId, PDO::PARAM_INT);
        $query->execute();
    }

    public function deleteReclaimer($reclamationId, $reclaimerId, $reclaimerType)
    {
        // Delete the reclamation
        $this->ignoreReclamation($reclamationId);

        // Determine which table to delete the reclaimer from based on reclaimerType
        $table = '';
        switch ($reclaimerType) {
            case 'commentaire':
                $table = 'commentaire';
                break;
            case 'client':
                $table = 'client';
                break;
            case 'partenaire':
                $table = 'partenaire';
                break;
            default:
                // Invalid reclaimerType
                return;
        }

        // Delete the reclaimer from the corresponding table
        $query = self::$instance->prepare("DELETE FROM $table WHERE id = :reclaimerId");
        $query->bindParam(':reclaimerId', $reclaimerId, PDO::PARAM_INT);
        $query->execute();
    }

    public function getAllSignals()
    {
        $query = self::$instance->prepare("SELECT * FROM reclamations");
        $query->execute();
        $signals = $query->fetchAll();

        return $signals;
    }
}
