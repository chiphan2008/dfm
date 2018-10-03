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
 * ModelManagerDevice.h
 * 
 * 
 */

#ifndef ModelManagerDevice_H_
#define ModelManagerDevice_H_

#include <QJsonObject>


#include "ModelDevModel.h"
#include "ModelNumber.h"
#include <QDateTime>
#include <QString>

#include "SWGObject.h"

namespace api {

class ModelManagerDevice: public SWGObject {
public:
    ModelManagerDevice();
    ModelManagerDevice(QString* json);
    virtual ~ModelManagerDevice();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelManagerDevice* fromJson(QString &jsonString);

    qint64 getId();
    void setId(qint64 id);

    ModelDevModel* getDeviceModel();
    void setDeviceModel(ModelDevModel* device_model);

    QString* getIdentity();
    void setIdentity(QString* identity);

    qint32 getIsRunning();
    void setIsRunning(qint32 is_running);

    qint64 getVersion();
    void setVersion(qint64 version);

    ModelNumber* getLat();
    void setLat(ModelNumber* lat);

    float getLng();
    void setLng(float lng);

    QDateTime* getCreatedAt();
    void setCreatedAt(QDateTime* created_at);

    QDateTime* getUpdatedAt();
    void setUpdatedAt(QDateTime* updated_at);


private:
    qint64 id;
    ModelDevModel* device_model;
    QString* identity;
    qint32 is_running;
    qint64 version;
    ModelNumber* lat;
    float lng;
    QDateTime* created_at;
    QDateTime* updated_at;
};

}

#endif /* ModelManagerDevice_H_ */