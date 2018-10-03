/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */

/*
 * ModelRouteForm.h
 * 
 * 
 */

#ifndef ModelRouteForm_H_
#define ModelRouteForm_H_

#include <QJsonObject>


#include "ModelBusStation.h"
#include <QList>
#include <QString>

#include "SWGObject.h"

namespace api {

class ModelRouteForm: public SWGObject {
public:
    ModelRouteForm();
    ModelRouteForm(QString* json);
    virtual ~ModelRouteForm();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelRouteForm* fromJson(QString &jsonString);

    qint64 getId();
    void setId(qint64 id);

    QString* getStartTime();
    void setStartTime(QString* start_time);

    QString* getEndTime();
    void setEndTime(QString* end_time);

    qint64 getNumber();
    void setNumber(qint64 number);

    QString* getName();
    void setName(QString* name);

    QList<ModelBusStation*>* getBusStations();
    void setBusStations(QList<ModelBusStation*>* bus_stations);


private:
    qint64 id;
    QString* start_time;
    QString* end_time;
    qint64 number;
    QString* name;
    QList<ModelBusStation*>* bus_stations;
};

}

#endif /* ModelRouteForm_H_ */