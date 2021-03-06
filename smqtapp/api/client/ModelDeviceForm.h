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
 * ModelDeviceForm.h
 * 
 * 
 */

#ifndef ModelDeviceForm_H_
#define ModelDeviceForm_H_

#include <QJsonObject>


#include <QString>

#include "SWGObject.h"

namespace api {

class ModelDeviceForm: public SWGObject {
public:
    ModelDeviceForm();
    ModelDeviceForm(QString* json);
    virtual ~ModelDeviceForm();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelDeviceForm* fromJson(QString &jsonString);

    qint64 getId();
    void setId(qint64 id);

    qint64 getDeviceModelId();
    void setDeviceModelId(qint64 device_model_id);

    QString* getIdentity();
    void setIdentity(QString* identity);

    qint32 getIsRunning();
    void setIsRunning(qint32 is_running);

    qint64 getVersion();
    void setVersion(qint64 version);

    float getLat();
    void setLat(float lat);

    float getLng();
    void setLng(float lng);


private:
    qint64 id;
    qint64 device_model_id;
    QString* identity;
    qint32 is_running;
    qint64 version;
    float lat;
    float lng;
};

}

#endif /* ModelDeviceForm_H_ */
