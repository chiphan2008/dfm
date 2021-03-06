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
 * ModelFirmwareForm.h
 * 
 * 
 */

#ifndef ModelFirmwareForm_H_
#define ModelFirmwareForm_H_

#include <QJsonObject>


#include <QString>

#include "SWGObject.h"

namespace api {

class ModelFirmwareForm: public SWGObject {
public:
    ModelFirmwareForm();
    ModelFirmwareForm(QString* json);
    virtual ~ModelFirmwareForm();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelFirmwareForm* fromJson(QString &jsonString);

    qint64 getId();
    void setId(qint64 id);

    qint64 getDeviceModelId();
    void setDeviceModelId(qint64 device_model_id);

    QString* getServerIp();
    void setServerIp(QString* server_ip);

    QString* getUsername();
    void setUsername(QString* username);

    QString* getPassword();
    void setPassword(QString* password);

    QString* getPath();
    void setPath(QString* path);

    qint32 getVersion();
    void setVersion(qint32 version);

    QString* getFilename();
    void setFilename(QString* filename);


private:
    qint64 id;
    qint64 device_model_id;
    QString* server_ip;
    QString* username;
    QString* password;
    QString* path;
    qint32 version;
    QString* filename;
};

}

#endif /* ModelFirmwareForm_H_ */
