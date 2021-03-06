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
 * ModelVehicle.h
 * 
 * 
 */

#ifndef ModelVehicle_H_
#define ModelVehicle_H_

#include <QJsonObject>


#include "ModelRfidCard.h"
#include "ModelRoute.h"
#include <QDateTime>
#include <QString>

#include "SWGObject.h"

namespace api {

class ModelVehicle: public SWGObject {
public:
    ModelVehicle();
    ModelVehicle(QString* json);
    virtual ~ModelVehicle();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelVehicle* fromJson(QString &jsonString);

    qint64 getId();
    void setId(qint64 id);

    ModelRfidCard* getRfidcard();
    void setRfidcard(ModelRfidCard* rfidcard);

    qint64 getComanyId();
    void setComanyId(qint64 comany_id);

    qint64 getRouteId();
    void setRouteId(qint64 route_id);

    qint64 getDeviceId();
    void setDeviceId(qint64 device_id);

    ModelRoute* getRoute();
    void setRoute(ModelRoute* route);

    qint32 getIsRunning();
    void setIsRunning(qint32 is_running);

    QString* getLicensePlates();
    void setLicensePlates(QString* license_plates);

    QString* getRfid();
    void setRfid(QString* rfid);

    float getLat();
    void setLat(float lat);

    float getLng();
    void setLng(float lng);

    QDateTime* getCreatedAt();
    void setCreatedAt(QDateTime* created_at);

    QDateTime* getUpdatedAt();
    void setUpdatedAt(QDateTime* updated_at);


private:
    qint64 id;
    ModelRfidCard* rfidcard;
    qint64 comany_id;
    qint64 route_id;
    qint64 device_id;
    ModelRoute* route;
    qint32 is_running;
    QString* license_plates;
    QString* rfid;
    float lat;
    float lng;
    QDateTime* created_at;
    QDateTime* updated_at;
};

}

#endif /* ModelVehicle_H_ */
