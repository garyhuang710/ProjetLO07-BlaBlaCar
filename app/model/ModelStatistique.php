<?php

class ModelStatistique
{
    public static function dashboard(): array
    {
        return [
            'totaux' => Model::selectOne(
                'select
                    (select count(*) from utilisateur) as utilisateurs,
                    (select count(*) from trajet where statut = "actif") as trajets_actifs,
                    (select count(*) from reservation) as reservations,
                    (select coalesce(sum(t.prix), 0)
                     from reservation r join trajet t on t.id = r.trajet_id) as volume_reservations'
            ),
            'routes' => Model::select(
                'select concat(vd.nom, " -> ", va.nom) as route_label,
                        count(r.id) as reservations,
                        coalesce(sum(t.prix), 0) as volume
                 from trajet t
                 join ville vd on vd.id = t.ville_depart
                 join ville va on va.id = t.ville_arrivee
                 left join reservation r on r.trajet_id = t.id
                 group by t.ville_depart, t.ville_arrivee, vd.nom, va.nom
                 order by reservations desc, volume desc
                 limit 8'
            ),
            'conducteurs' => Model::select(
                'select concat(u.prenom, " ", u.nom) as conducteur,
                        count(distinct t.id) as trajets,
                        count(r.id) as reservations,
                        coalesce(sum(t.prix), 0) as volume
                 from utilisateur u
                 left join trajet t on t.conducteur_id = u.id
                 left join reservation r on r.trajet_id = t.id
                 where u.role = "conducteur"
                 group by u.id, u.prenom, u.nom
                 order by volume desc, reservations desc'
            ),
        ];
    }
}
