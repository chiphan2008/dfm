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
 * ModelVehicleForm.h
 * 
 * 
 */

#ifndef ModelVehicleForm_H_
#define ModelVehicleForm_H_

#include <QJsonObject>


#include <QString>

#include "SWGObject.h"

namespace api {

class ModelVehicleForm: public SWGObject {
public:
    ModelVehicleForm();
    ModelVehicleForm(QString* json);
    virtual ~ModelVehicleForm();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelVehicleForm* fromJson(QString &jsonString);

    qint64 getId();
    void setId(qint64 id);

    qint64 getComanyId();
    void setComanyId(qint64 comany_id);

    qint64 getRouteId();
    void setRouteId(qint64 route_id);

    qint32 getIsRunning();
    void setIsRunning(qint32 is_running);

    QString* getLicensePlates();
    void setLicensePlates(QString* license_plates);

    QString* getRfid();
    void setRfid(QString* rfid);


private:
    qint64 id;
    qint64 comany_id;
    qint64 route_id;
    qint32 is_running;
    QString* license_plates;
    QString* rfid;
};

}

#endif /* ModelVehicleForm_H_ */
